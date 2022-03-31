<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\CheckedOutBook;
use App\LibraryBook;
use App\LoanedBook;
use App\RequestedBook;
use App\StorageBook;
use App\User;
use App\School;
use Carbon\Carbon;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Khill\Lavacharts\Lavacharts;

class BookController extends Controller
{
	/*************************************************************
	* create a book
	**************************************************************
	*@params Request
	*@return view
	*/
    public function createBook(Request $request)
    {
    	$this->validate($request,[
    		'school_id' =>'required|numeric|min:1',
    		'isbn_number' => 'required|string|min:1',
    		'title' => 'required|string|min:1',
    		'author' =>'required|string|min:1',
    		'year' =>'required|numeric',
    		'grade' =>'required|numeric|max:12',
    		'quantity' =>'required|numeric',
    		'description' =>'required|string',
            'book_cover' =>'required'
    	]);

    	$book = new Book();
    	$book->school_id = $request['school_id'];
    	$book->isbn_number = $request['isbn_number'];
    	$book->title = $request['title'];
    	$book->author = $request['author'];
    	$book->year = $request['year'];
    	$book->grade = $request['grade'];
    	$book->quantity = $request['quantity'];
    	$book->description = $request['description'];
    	

        if($book->save())
        {
            # saves image
            $file = $request['book_cover'];
            if($file)
            {
                $picture_type = 'books';
                if(Image::where('path',Auth::user()->slug.Auth::id().'/'.$picture_type.'/')->max('pic_number') != null)
            {
                $num_pics = Image::where('path',Auth::user()->slug.Auth::id().'/'.$picture_type.'/')->max('pic_number');
                $num_pics +=1;
            }
            else
            {
                $num_pics = 1;
            }
                //$num_pics = count(Storage::files(Auth::user()->slug.Auth::user()->id.'/'.$picture_type.'/'));
                //$num_pics+=1;
                \Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$num_pics);
                $image = new Image();
                $image->path = Auth::user()->slug.'/books/';
                $image->name = Auth::user()->slug.'-books-'.$num_pics.'.jpg';
                $book->images()->save($image);
            }
        }
    	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
    }

    /*************************************************************
	* check out a book
	**************************************************************
	*@params Request
	*@return view
	*/
    public function createCheckedOutBook(Request $request)
    {
    	$this->validate($request,[
    		'school_id' =>'required|numeric|min:1',
    		'requested_book_id' =>'required|numeric|min:1',
    		'checkedable_id' =>'required|numeric|min:1',
    		'checkedable_type' =>'required|string',
    		'date_checked_out' =>'required|date',
    		'due_date' =>'required|date',
    		'returned' =>'required|numeric|min:0|max:1',
    	]);

    	$checked_out_book = new CheckedOutBook();
    	$checked_out_book->school_id = $request['school_id'];
    	$checked_out_book->requested_book_id = $request['requested_book_id'];
    	$checked_out_book->checkedable_id = $request['checkedable_id'];
    	$checked_out_book->checkedable_type = $request['checkedable_type'];
    	$checked_out_book->date_checked_out = $request['date_checked_out'];
    	$checked_out_book->due_date = $request['due_date'];
    	$checked_out_book->returned = $request['returned'];
    	$checked_out_book->save();
    	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
    }



    /*************************************************************
	* create a library book 
	**************************************************************
	*@params Request
	*@return view
	*/
    public function createLibraryBook(Request $request)
    {
    	$this->validate($request,[
    		'school_id' =>'required|numeric|min:1',
    		'book_id' =>'required|numeric|min:1',
    		'format' =>'required|string',
    		'library_quantity' =>'required|numeric',
    		'reserved' =>'required|numeric|min:0|max:1',
    		'num_available' =>'required|numeric',
    		'location' =>'string',
    		'book_identification' =>'required|string',
    	]);

    	$library_book = new LibraryBook();
    	$library_book->school_id=$request['school_id'];
    	$library_book->book_id=$request['book_id'];
    	$library_book->format =$request['format'];
    	$library_book->quantity=$request['library_quantity'];
    	$library_book->reserved=$request['reserved'];
    	$library_book->num_available =$request['num_available'];
    	$library_book->location =$request['location'];
    	$library_book->book_identification=$request['book_identification'];
    	$library_book->save();
    	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
    }

    /*************************************************************
	* create a loaned book 
	**************************************************************
	*@params
	*@return
	*/
    public function createLoanedBook(Request $request)
    {
    	$this->validate($request,[
    		'school_id' =>'required|numeric|min:1',
    		'book_id' =>'required|numeric|min:1',
    		'school_student_id' =>'required|array|min:1',
    		'book_number' =>'required|array',
            'school_student_id.*' =>'required|numeric|min:1',
            'book_number.*' =>'required|string',
    	]);

        foreach ($request['school_student_id'] as $key => $student) 
        {
            $loaned_book = new LoanedBook();
            $loaned_book->school_id=$request['school_id'];
            $loaned_book->book_id=$request['book_id'];
            $loaned_book->school_student_id=$student;
            $loaned_book->year=Carbon::now()->year;
            $loaned_book->book_identification=$request['book_number'][$key];
            $loaned_book->returned=0;
            if($loaned_book->save())
            {
               return redirect()->back()->with(['message'=>'Books successfully loaned to students!!']); 
            }
        }
    	
    	
    }

    /*************************************************************
	* create requested book
	**************************************************************
	*@params Request
	*@return view
	*/
    public function createRequestedBook(Request $request)
    {
    	$this->validate($request,[
    		'school_id' =>'required|numeric|min:1',
    		'book_id' =>'required|numeric|min:1',
    	]);
        
        $library_book = LibraryBook::where('school_id',$request['school_id'])->where('book_id',$request['book_id'])->first();
    	$requested_book = new RequestedBook();
    	$requested_book->school_id=$request['school_id'];
    	$requested_book->library_book_id=$library_book->id;
    	$requested_book->requestable_id=Auth::id();
    	$requested_book->requestable_type=Auth::user()->usable_type;
    	$requested_book->date_requested=Carbon::now();
    	$requested_book->book_identification=$library_book->book_identification;
    	$requested_book->save();
        $library_book->num_available--;
        $library_book->update();
    	return redirect()->back()->with(['message'=>'Thank you for your input!!','books'=>\Session()->get('books')]);
    }

    /*************************************************************
	* create storage book
	**************************************************************
	*@params Request
	*@return view
	*/
    public function createStorageBook(Request $request)
    {
    	$this->validate($request,[
			'school_id' =>'required|numeric|min:1',
			'book_id' =>'required|numeric|min:1',
			'storage_quantity' =>'required|numeric',
    	]);

    	$storage_book = new StorageBook();
    	$storage_book->school_id =$request['school_id'];
    	$storage_book->book_id=$request['book_id'];
    	$storage_book->quantity=$request['storage_quantity'];
    	$storage_book->save();
    	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
    }

    /**********************************************************************************
    *
    **********************************************************************************
    *
    *
    */
    public function getLibraryPage(User $user)
    {
        $books = Book::where('school_id',$user->usable_id)->select('category')->distinct()->get();
        $featured_books = LibraryBook::where('school_id',$user->usable_id)->inRandomOrder()->skip(0)->take(9)->get();
        return view('school.library.libraryPage',['userIdNo' => $user,'books'=>$books,'featured_books'=>$featured_books]);
    }

    /**********************************************************************************
    *
    **********************************************************************************
    *
    *
    */
    public function searchLibrary(Request $request)
    {
        $this->validate($request,[
            'grade'=> 'numeric',
            'category' => 'string',
            'search_query' => 'required|string'
        ]);

        $category = $request['category'];
        $grade = $request['grade'];
        $search_query = $request['search_query'];

        if(($grade== 0 && $category == 'default') )
        {
            $books = Book::with('libraryBook')->where('school_id',$request['userIdNo'])->where('title','LIKE','%'.$search_query.'%')->get();
        }
        elseif ($grade == 0 && $category != 'default')
        {
           $books = Book::with('libraryBook')->where('school_id',$request['userIdNo'])->where('category',$category)->where('title','LIKE','%'.$search_query.'%')->get();
        }
        elseif ($grade != 0 && $category == 'default')
        {
            $books = Book::with('libraryBook')->where('school_id',$request['userIdNo'])->where('grade',$grade)->where('title','LIKE','%'.$search_query.'%')->get();
        }
        else
        {
            $books = Book::with('libraryBook')->where('school_id',$request['userIdNo'])->where('grade',$grade)->where('category',$category)->where('title','LIKE','%'.$search_query.'%')->get();
        }
       $request->session()->put('books',$books);
        return redirect()->action('BookController@librarySearchResults', ['user'=>User::find($request['userIdNo']), 'query_result' =>$search_query]);
    }


    public function librarySearchResults(User $user,$query_result)
    {
      
        return view('school.library.libraryResultsPage',['userIdNo' => $user,'books'=>\Session::get('books'), 'query_result' =>$query_result]);
    }

    /********************************************************************************
    *
    *********************************************************************************
    *
    *
    */
    public function requestABook(Request $request)
    {
        dd($request);
    }

    /********************************************************************************
    *
    *********************************************************************************
    *
    *
    */
    public function getBooks(User $user,Request $request)
    {

        //dd($current = Carbon::now()->month);
        #Create graphs 
        $books = \Lava::DataTable();

        $books->addStringColumn('Books')
        ->addNumberColumn('Percent')
        ->addRow(['Checked out', CheckedOutBook::where('school_id',$user->usable_id)->count()])
        ->addRow(['Library', LoanedBook::where('school_id',$user->usable_id)->count()])
        ->addRow(['Loaned to student', LoanedBook::where('school_id',$user->usable_id)->count()])
        ->addRow(['Storage', StorageBook::where('school_id',$user->usable_id)->count()]);

        \Lava::PieChart('books', $books, [
            'title'  => 'All Books',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.1],
                ['offset' => 0.1],
                ['offset' => 0.1]
            ]
        ]);


        $loan = \Lava::DataTable();

        $loan->addDateColumn('Week')
        ->addNumberColumn('Books checked out')
        ->addRow(['2006', 623452])
        ->addRow(['2007', 685034])
        ->addRow(['2008', 716845])
        ->addRow(['2009', 757254])
        ->addRow(['2010', 778034])
        ->addRow(['2011', 792353])
        ->addRow(['2012', 839657])
        ->addRow(['2013', 842367])
        ->addRow(['2014', 873490]);

        \Lava::AreaChart('loan', $loan, [
            'title' => 'Book loaning rate',
            'legend' => [
                'position' => 'in'
            ]
        ]);

        $books = Book::where('school_id',$user->usable_id)->orderBy('title', 'asc')->paginate(6);
        if ($request->ajax()) 
        {
            
                $view = view('book.booksData',['userIdNo' => $user,'books'=>$books])->render();
                return response()->json(['html'=>$view]);
        }
        return view('book.booksPage',['userIdNo' => $user,'books'=>$books]);
    }
}
