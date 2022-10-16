<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use DB;
use Excel;
use Mail;
use app\Models\Comment;
use App\Models\User;
use App\Models\SiteUser;
use App\Models\UserDetail;
use App\Models\province;
use App\Models\sector;
use App\Models\district;
use App\Models\village;
use App\Models\cell;
use App\Models\TrainingReport;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.login');
    }


public function signup(){
    return view('pages.register');
}

public function signin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
//    check if the email is verified
$userauth = User::where('email',$request->get('email'))->first();

var_dump($userauth);
if($userauth->varified == 0){
$to_name = $userauth->names;
$to_email = $request->get('email');
$link = 'localhost/richard/public/activate_email/'.base64_encode($to_email);
$data = array('name'=>$to_name, 'actlink'=>$link, 'body' => 'Activation Email');
//   base64_encode()
Mail::send('emails.activate', $data, function($message) use ($to_name, $to_email) {
$message->to($to_email, $to_name)
->subject('Activation Email');
$message->from('iribatech@gmail.com','Activation Email');
});
return redirect("login")->with('message','check your email and verify your account first!');
}
else{
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect("dashboard")->withSuccess('Signed in');
    }
    return redirect("login")->with('message','Login details are not valid');
}
}
// register
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->with('success','welcome, you are signed in');
    }

    public function createUser(Request $request){
        $request->validate([
            'names' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id'=>'required|exists:roles,id'
        ]);
    }
    // signup function
        public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'role_id'=>1,
        'password' => Hash::make($data['password'])
      ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            $users = User::where('role_id','!=',1)->get();
            $provinces = province::count();
            $districts = district::count();
            $sectors = sector::count();
            $cells = cell::count();
            $villages = village::count();
            $roles = DB::table('roles')->count();
            $trainees = DB::table('training_reports')->count();

            $data = ['users'=>$users,
                    'provinces'=>$provinces,
                    'districts'=>$districts,
                    'sectors'=>$sectors,
                    'cells'=>$cells,
                    'user_type'=>$roles,
                    'trained'=>$trainees,
                    'villages'=>$villages];
                    
            return view('pages.dashboard',$data);
                            }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
// get all users
    public function getUsersAll(){

        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $users = User::join('user_details','user_details.user_id','=','users.id')
        ->join('roles','roles.id','=','users.role_id')
        ->select('users.id','users.name','users.email','roles.role','user_details.gender','user_details.phone_number','user_details.high_education','user_details.location','user_details.image')
        ->where('users.role_id','!=',1)->get();
$data = ['users'=>$users];
        // `gender`, `date_of_birth`, `phone_number`, `high_education`, `location`, `image`
        return view('pages.users',$data);
    }
/***
 * all sites
 */
public function allSites(){

    if(!Auth::check()){
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    $sites = DB::table('cells')->join('sectors','sectors.id','=','cells.sector')
                ->join('districts','districts.id','=','sectors.district')
                ->select('cells.name as site','sectors.name as sector','districts.name as district')->get();
                $count = 1;
    $data = ['sites'=>$sites,
                'count'=>$count];
                // var_dump($sites);
    return view('pages.allsites',$data);
    // echo "sites management";
}

    // return create a new user
    public function addNewUser(){
        $roles = DB::table('roles')->where('roles.id','!=',1)->get();
        $provinces = province::get();
        $data = ['roles'=>$roles];
        return view('pages.new_user',$data);
    }

    public function addReport(){

        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        // SiteUser
        $mysites = SiteUser::join('cells','cells.id','=','site_users.cell_id')
                    ->select('cells.name as sites','site_users.id')
                    ->where('site_users.user_id','=',auth()->user()->id)
                    ->where('site_users.status',1)->get();

        $data = ['sites'=>$mysites];
        return view('pages.training_report',$data);
    }

    public function saveReport(Request $request){

        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
// TrainingReport
        $date_of_training=$request->get('date_of_trainig');
        $site = $request->get('site_id');
        $reportname = auth()->user()->name."_on date_".$date_of_training;
        Report::create([
            'report_name'=>$reportname, 
            'date_of_training'=>$date_of_training, 
            'site_id'=>$site, 
            'user_id'=>auth()->user()->id
        ]);

        $reportId = Report::max('id');
        if ($request->hasFile('training_report')) {
        $path = $request->file('training_report')->getRealPath();
        $dataAll = fopen($path,"r");
        while (($value = fgetcsv($dataAll, 10000, ",")) !== FALSE)
        {
            TrainingReport::create(['names'=>$value[0],
                                'gender'=>$value[1],
                                'phone_number' => $value[2],
                                'nationalId' => $value[3],
                                'district' => $value[4],
                                'sector' => $value[5],
                                'cell' => $value[6],
                                'date_of_training'=>$value[7],
                                'report_id'=>$reportId
            ]);
        }
       return redirect()->route('training_report')->with('success', 'Report Submitted successfully!');
    }
    }

    // /trainers in my district
    public function myTrainers(){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }

            $mydistrict = SiteUser::where('user_id',auth()->user()->id)
            ->where('status',1)    
            ->first();
            if(empty($mydistrict)){
                $data = ['users'=>null];
            }
            else{
                $user_id = SiteUser::where('district',$mydistrict->district)
                ->where('status',1)
                ->select('user_id')
                ->distinct()
                ->get();
            $users = User::join('user_details','user_details.user_id','=','users.id')
                ->join('roles','roles.id','=','users.role_id')
                ->select('users.id','users.name','users.email','roles.role','user_details.gender','user_details.phone_number','user_details.high_education','user_details.location','user_details.image')
                ->whereIn('users.id',$user_id)->get();
            $data = ['users'=>$users];
            }

        return view('pages.my_trainers',$data);
                    // my_trainers

    }
    // return reports on trainer and field supervisor

    public function myReports(){

        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        // /check if it is the supervisor or trainer

        if(auth()->user()->role_id == 3){
            $mydistrict = SiteUser::where('user_id',auth()->user()->id)
            ->where('status',1)    
            ->first();
            if(empty($mydistrict)){
                $myreports = null;
            }
            else{
                $sites = SiteUser::where('district',$mydistrict->district)
                ->where('status',1)
                ->select('id')->get();

                $myreports = Report::join('site_users','site_users.id','=','reports.site_id')
                ->join('cells','cells.id','=','site_users.cell_id')
                ->select('reports.id','cells.name as site','reports.report_name','reports.date_of_training','reports.status')
                ->whereIn('reports.site_id',$sites)
               //  ->where('reports.status',1)
                ->orderBy('reports.id', 'DESC')
                ->get();
            }
            // echo $myreports;
        }
        else{
            $myreports = Report::join('site_users','site_users.id','=','reports.site_id')
            ->join('cells','cells.id','=','site_users.cell_id')
            ->select('reports.id','cells.name as site','reports.report_name','reports.date_of_training','reports.status')
            ->where('reports.user_id',auth()->user()->id)
           //  ->where('reports.status',1)
            ->orderBy('reports.id', 'DESC')
            ->get();

        }
        
        $data = ['myreports'=>$myreports];
        return view('pages.my_reports',$data);
    }
    // reports details
    public function trainingReport(){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
           $report = TrainingReport::get();
            $data=['reports'=>$report];
            return view('pages.reports',$data);
    }

    public function showreport($reportId){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        // echo "string ".$reportId;
    $report = TrainingReport::where('id',$reportId)->first();
    $data=['reports'=>$report];
        return view('pages.singletrainee',$data);
    }

    // changeStatus change status
    public function changeStatus($reportId){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $reportsdetails = Report::where('id',$reportId)->first();
        if($reportsdetails->status == 1){
            $reportsdetails->status = 0;
        }
        else{
            $reportsdetails->status = 1;
        }
        $reportsdetails->save();
        return redirect()->route('my_reports')->with('success', 'The status has been changes successfully.');
    }
// /make a comment
public function putComment($reportId){
    if(!Auth::check()){
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    $reportsdetails = Report::join('users','users.id','=','reports.user_id')
                        ->join('user_details','user_details.user_id','=','users.id')
                        ->select('users.email','users.name','user_details.image','reports.report_name','reports.id')
                        ->where('reports.id',$reportId)->first();
    $data = ['user'=>$reportsdetails];
    return view('pages.make_comment',$data);
}

    // return report details

    public function showReportDetails($reportId){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $report = TrainingReport::where('report_id',$reportId)->get();
        $data=['reports'=>$report];
        return view('pages.reports',$data);

    }
    public function updateReport(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }

        // var_dump($request->get('names'));
        $report = TrainingReport::where('id',$request->get('reportid'))->first();
        $report->names = $request->get('names'); 
        $report->gender = $request->get('gender'); 
        $report->phone_number = $request->get('phone_number'); 
        $report->nationalId = $request->get('national_id'); 
        $report->district = $request->get('district'); 
        $report->sector = $request->get('sector'); 
        $report->cell =$request->get('cell');
        $report->save();
return redirect()->route('training_report')->with('success', 'User updated successfully.');
    }

    public function registerUSer(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $request->validate([
            'names'=>'required',
            'email'=>'required|email|unique:users,email',
            'role_id'=>'required:exists:roles,id'
        ]);
        // var_dump($request->all());
    User::create([
        'name' => $request->get('names'),
        'email' => $request->get('email'),
        'role_id'=>$request->get('role_id'),
        'password' => Hash::make('12345678'),
        'varified' => 0
      ]);

    $user_id = User::max('id');
    UserDetail::create(['user_id'=>$user_id]);


// send activation email
// $to_name = $request->get('names');
// $to_email = $request->get('email');
// $link = 'localhost/richard/public/activate_email/'.base64_encode($to_email);
// $data = array('name'=>$to_name, 'actlink'=>$link, 'body' => 'Activation Email');
  
// Mail::send('emails.activate', $data, function($message) use ($to_name, $to_email) {
// $message->to($to_email, $to_name)
// ->subject('Activation Email');
// $message->from('iribatech@gmail.com','Activation Email');
// });
    return redirect()->route('getusers')->with('success', 'User registered successfully.');

    }

    // return activate email
    public function activateEmail($email){
        // if(!Auth::check()){
        //     return redirect("login")->withSuccess('You are not allowed to access');
        // }
        // var_dump($email);
        $myemail = base64_decode($email);
        $thisuser = User::where('email',$myemail)->first();
        if ($thisuser->varified == 1) {
            // return redirect()->route('getusers');
            return redirect("login")->withSuccess('Your account is already verified');
        }
        else{
            $data = ['user'=>$thisuser];
            return view('pages.activateview',$data);
        }
    }


    public function activateUser(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $user_id=$request->get('user_id');
        $pwd = $request->get('password');

        $user = User::where('id',$user_id)->first();
        $user->password=Hash::make($pwd);
        $user->varified=1;
        $user->save();

        return redirect()->route('signout')->with('success', 'Success, your Account has been activated.');

    }

    // return my profile

    public function myProfile(){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $user = User::join('user_details','user_details.user_id','=','users.id')
                ->join('roles','roles.id','=','users.role_id')
                ->select('users.id','users.name','users.email','user_details.gender', 'user_details.date_of_birth', 'user_details.phone_number', 'user_details.high_education', 'user_details.location', 'user_details.image','roles.role')
                ->where('users.id',auth()->user()->id)
                ->first();
        $provinces = province::all();

                $data = ['user'=>$user,
                        'provinces'=>$provinces
                ];
        return view('pages.myprofile',$data);
    }

    // get districts in a province

    public function getSectors(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $district = $request->get('district');
        $sectors = sector::where('district',$district)->get();
        // echo $province;
        return response()->json(['message'=>"success",'data'=>$sectors,'status'=>200]);
    }

    /**
     * get all cells as sites
     */
    public function getSites(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $sector = $request->get('sector');
        $cells = cell::where('sector',$sector)->get();
        return response()->json(['message'=>"success",'data'=>$cells,'status'=>200]);

    }
    // update the profile

    public function updateProfile(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $user = User::where('id',$request->get('userId'))->first();
        $userdetails = UserDetail::where('user_id',$user->id)->first();
        var_dump($request->all());
        // 'gender', 'date_of_birth', 'phone_number', 'high_education', 'location', 'image'
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            // $this->save();
            $userdetails->image = $name;
        }
        $user->name=$request->get('names');
        $user->save();
        $userdetails->gender=$request->get('gender');
        $userdetails->date_of_birth = $request->get('dob');
        $userdetails->phone_number = $request->get('phone_number');
        $userdetails->high_education = $request->get('level_of_education');
        $userdetails->location =$request->get('location');
        $userdetails->save();
        // return back()->with('success','Image Upload successfully');
        return redirect()->route('my_profile')->with('success', 'Success, your Account has been activated.');
    }


    // return page to allocate the trainer to the sites
    public function return_allocate($userId){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $user = User::join('user_details','user_details.user_id','=','users.id')
        ->join('roles','roles.id','=','users.role_id')
        ->select('users.id','users.role_id','users.name','users.email','user_details.gender', 'user_details.date_of_birth', 'user_details.phone_number', 'user_details.high_education', 'user_details.location', 'user_details.image','roles.role')
        ->where('users.id',$userId)
        ->first();
        $districts = district::all();

        $data = ['user'=>$user,
                'districts'=>$districts
        ];
        return view('pages.allocate',$data);
        // allocate.blade.php
    }
// get list of trainers and field supervisors

public function trainerSandSuperv(){
    if(!Auth::check()){
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    // echo "ndashima yezu mucunguzi";

    $users = User::join('user_details','user_details.user_id','=','users.id')
    ->join('roles','roles.id','=','users.role_id')
    ->select('users.id','users.role_id','users.name','users.email','roles.role','user_details.gender','user_details.phone_number','user_details.high_education','user_details.location','user_details.image')
    ->whereIn('users.role_id',[3,4])->get();
$sites =array();
foreach($users as $key=>$value){
    $users[$key]->sites = SiteUser::join('districts','districts.id','=','site_users.district')
                                    ->select('districts.name as district')
                                    ->where('site_users.status',1)
                                    ->where('site_users.user_id',$value->id)->get();

}
$data = ['users'=>$users];
return view('pages.trainerandsuperv',$data);
}
    public function allocateUserInPlace(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        // disable past allocations
        $locate = SiteUser::where('user_id',$request->get('user_id'))->fist();
        $locate->status=0;
        $locate->save();
// now insert new records

        if($request->get('role_id') == 3){
            SiteUser::create([
                'user_id'=>$request->get('user_id'),
                'district'=>$request->get('district'),
                'status'=>1,
            ]);
        }
        else{
            // sites
            foreach($request->get('sites') as $val){
            SiteUser::create([
                'user_id'=>$request->get('user_id'),
                'district'=>$request->get('district'),
                'sector_id'=>$request->get('sector'),
                'cell_id'=>$val,
                'status'=>1,
            ]);

            }
        }

        return redirect()->route('getusers')->with('success', 'User Allocated successfully.');

    }

    // get report of trainers in my district

    public function sendComment(Request $request){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }

$user = User::where('email',$request->get('email_to'))->first();
$sender = auth()->user()->email;
// Comment
$to_name = $user->name;
$to_email = $user->email;
$comment = $request->get('message');
// $link = 'localhost/richard/public/activate_email/'.base64_encode($to_email);
$data = array('name'=>$to_name,'comment'=>$comment, 'report'=>$request->get('report'), 'body' => 'Comment about Report');
  
Mail::send('emails.comment', $data, function($message) use ($to_name, $to_email) {
$message->to($to_email, $to_name)
->subject('Comment about Report');
$message->from('iribatech@gmail.com','Activation Email');
});

return redirect()->route('my_reports')->with('success', 'The Comment has been sent successfully.');

    }

    // report by year month or day
    public function trainingReportFilter(){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $reports = Report::join('users','users.id','=','reports.user_id')
                            ->join('site_users','site_users.id','=','reports.site_id')
                            ->join('districts','districts.id','=','site_users.district')
                            ->select('reports.id','users.name','districts.name as district','reports.report_name','reports.date_of_training')
                            ->orderBy('reports.id','DESC')
                            ->get();

        $data = ['reports'=>$reports];
        return view('pages.reportsbycategories',$data);
    }

    // reports in the dashboards
    public function getDataForCharts(){
           $reportsdetails = TrainingReport::select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year'),DB::raw('monthname(created_at) month'))
   ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('monthname(created_at)'))
   ->get();
//    reports by sites
// $reports = Report::select(DB::raw('count(id) as `data`'),DB::raw('site_id'),DB::raw('YEAR(created_at) year'),DB::raw('MONTH(created_at) month'))
// ->groupBy(DB::raw('site_id'),DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
// ->get();

return response()->json(['message'=>"success",'reports'=>$reportsdetails,'status'=>200]);
    }
    // get 4 last registered users
    public function getLatestUsers(){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $users = User::join('user_details','user_details.user_id','=','users.id')
        ->join('roles','roles.id','=','users.role_id')
        ->select('users.id','users.name','users.email','roles.role','user_details.gender','user_details.phone_number','user_details.high_education','user_details.location','user_details.image')
        ->where('users.role_id','!=',1)->limit(4)->get();
        return response()->json(['message'=>"success",'data'=>$users,'status'=>200]);
    }

    // get recent 5 reports

    public function getRecentReport(){
        if(!Auth::check()){
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $reports =  Report::join('users','users.id','=','reports.user_id')
                    ->select('reports.id','reports.report_name','users.name')
                    ->orderBy('reports.id','DESC')
                    ->limit(4)
                    ->get();
    return response()->json(['message'=>"success",'data'=>$reports,'status'=>200]);              
    }
}
