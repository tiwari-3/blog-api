<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = User::all();
        $users = User::simplepaginate(2);
        //$users = User::find(2, ['name', 'email']);
        //$users = User::find([2,3], ['name', 'email']);
        //$users = User::count();
        //$users = User::min('age');
        //$users = User::max('age');
        //$users = User::sum('age');
        //$users = User::avg('age');
        //$users = User::where('city', 'Indore')->get();
        /* $users = User::where('city', 'Indore')
                    ->where('age', '>', 18)    
                    ->get(); */
        /* $users = User::where([
            ['city', 'Indore'],
            ['age', '>', 18]
        ])->get();   */  
                /* $users = User::where('city', 'Indore')
                ->orWhere('age', '>', 18)->get(); */ 
        
       /*  $users = User::where('city', 'Indore')
                ->orWhere('age', '>', 18)->count(); */

        /* $users = User::whereCity('Indore')
                        ->whereAge(18)
                        ->select('name', 'email as User Email')
                        ->get(); */
         /* $users = User::whereCity('Indore')
                        ->whereAge(18)
                        ->select('name', 'email as User Email')
                        ->toSql(); // Without values */
        /* $users = User::whereCity('Indore')
                        ->whereAge(18)
                        ->select('name', 'email as User Email')            
                        ->toRawSql(); // with value  */ 
        /* $users = User::whereCity('Indore')
                        ->whereAge(18)
                        ->select('name', 'email as User Email')            
                        ->dd(); */ 
        /* $users = User::whereCity('Indore')
                    ->whereAge(18)
                    ->select('name', 'email as User Email')            
    ->ddRawSql(); */  
    /*$users = User::whereCity('Indore')->first();  */     
    
        //$users = User::where('Age', '<>',18)->get();
        //$users = User::whereNot('Age',18)->get();
        //$users = User::whereBetween('Age', [18,30])->get();
        //$users = USer::whereNotBetween('Age', [18,30])->get();
        //return $users;
        /* foreach($users as $user){
            echo $user->name;
        } */

       /*  $users = User::whereIn('city', ['Indore','Goa'])->get(); */
       // $users = User::whereNotIn('city', ['Indore','Goa'])->get();
        //User::selectRaw('name,city')->get();
        //User::whereRaw('age>18')->get();
        //whereRaw('age>?', [20]);
        //User::orderBy('age','city')->get();
       // User::orderByRaw('age,city', 'asc')->get();

        /* if(User::where('id', 1)->exists()){

        }

        if(User::where('id', 1)->doesntExist()){

        } */
        return view("home", compact('users'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        /* $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save(); */

        /* if it is not working then add protected $guarded= [] in User Model;*/

        /* protected $fillable = ['name', 'email'] to fill the value in database */
        /* User:: create([
            'name' => $request->name,
            'email' => $request->email
        ]);
 */
        return view("adduser");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'useremail' => 'required|email',
            'userage' => 'required|numeric',
            'usercity' => 'required|alpha',
        ]);

        $user = new User;
        $user->name = $request->username;
        $user->email = $request->useremail;
        $user->age = $request->userage;
        $user->city = $request->usercity;
        $user->save();

        return redirect()->route('user.index')
                        ->with('status', 'New User Added successfully'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::find($id);
        return view("viewuser", compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view("updateuser", compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string',
            'useremail' => 'required|email',
            'userage' => 'required|numeric',
            'usercity' => 'required|alpha',
        ]);
        
        // Method : 1
        $user = User::find($id);
        $user->name = $request->username;
        $user->email = $request->useremail;
        $user->age = $request->userage;
        $user->city = $request->usercity;
        $user->save();

        return redirect()->route('user.index')->with('status', 'User data updated successfully');

        // Method : 2
        /* User::find(2)->update([
            'email' => $request->useremail;
        ]); */

        /* User::where('name', 'mayank')
                ->update([
                    'email' => 'mayank@gmail.com',
                ]); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method 1
        $users = User::find($id);
        $users->delete();

        return redirect()->route('user.index')->with('status', 'User data deleted successfully');

        //Method 2
        /* User::destroy(1);
        User::destroy(1,2,3);
        User::destroy([1,2,3]); */

        //Method 3
        //User::truncate();
        // Delete all data in database table.
        // Reset the auto-incrementing ID.
    }
}
