<?php

	namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use App\Post;
	use Mail;
	use Session;

	class PagesController extends Controller{
		public function getIndex(){
			$posts=Post::orderBy('created_at','desc')->limit(4)->get();
			return view('pages.welcome')->withPosts($posts);
		}
		public function getAbout(){
			$first = "Timur";
			$last = "Davletshin";

			$fullname = $first." ".$last;
			$email = "dhookm@rambler.ru";
			$data = [];//array
			$data['email'] = $email;
			$data['fullname'] = $fullname;
			return view('pages.about')->withData($data);//it is important to call withData cuz otherwise $data it's not gonna be valid
			//->with("fullname",$fullname);
		}

		public function getContact(){
			return view('pages.contact');
		}
		public function postContact(Request $request){
			
			$this->validate($request,[	'email' 	=> 'required|email',
										'subject'	=> 'required',
										'message'		=> 'required']);
		
		$data = [
			'email'		=> $request->email,
			'subject'	=> $request->subject,
			'bodyMessage'	=> $request->message];
			//dd($request);
		Mail::send('emails.contact',$data,function($message)use($data){
			$message->from($data['email']);
			$message->to('bruce_lee_22@inbox.ru');
			$message->subject($data['subject']);
		});
		Session::flash('success','Success');
		return view('pages.about');

		}//Mail::send('view',$data,function() Mail::queue();
	}