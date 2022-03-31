@foreach($students->chunk(3) as $chunk)
             <div class="row m-0">
            @foreach($chunk as $student)
            <div class="col-4">
              <figure class="figure">
                <?php
                  $reqbooks = array();
                  $chkdoutbooks = array();
                  $loanedbooks = array();
                  foreach ($student->requestedBook as $key => $rqb) 
                  {
                    $reqbooks[$key]=$rqb;
                    $book_title= $rqb->libraryBook->book->title;
                    $route = route('getPostPic',['filename'=>$rqb->libraryBook->book->images->first()->name,'folder'=>'books']);
                    $reqbooks[$key]['cover_src'] = $route ;
                    $reqbooks[$key]['title'] = $book_title ;
                  }

                  foreach ($student->checkedOutBook as $key => $cob)
                  {
                    $chkdoutbooks[$key] = $cob;
                    $book_title= $cob->requestedBook->libraryBook->book->title;
                    $route = route('getPostPic',['filename'=>$cob->requestedBook->libraryBook->book->images->first()->name,'folder'=>'books']);
                    $chkdoutbooks[$key]['cover_src'] = $route;
                    $chkdoutbooks[$key]['title']=$book_title;
                  }

                  foreach ($student->loanedBook as $key => $lob)
                  {
                    $loanedbooks[$key] = $lob;
                    $book_title= $lob->books->title;
                    $route = route('getPostPic',['filename'=>$lob->books->images->first()->name,'folder'=>'books']);
                    $loanedbooks[$key]['cover_src'] = $route;
                    $loanedbooks[$key]['title']=$book_title;
                  }
                  $reqbooks = json_encode($reqbooks);
                  $chkdoutbooks = json_encode($chkdoutbooks);
                  $loanedbooks = json_encode($loanedbooks);
                ?>
                <img src="{{route('getSchoolPictures',['user'=>$userIdNo,'school_student_id'=>$student->id])}}" class="figure-img img-fluid rounded-circle show-photo " alt="A generic square placeholder image with rounded corners in a figure." style="max-width: 100%;width:7rem;object-fit: cover;border-radius:50%;width: 50px;height: 50px;" data-student="{{$student}}" data-src="{{route('getSchoolPictures',['user'=>$userIdNo,'school_student_id'=>$student->id])}}" data-requestedBooks="{{$student->requestedBook->toJson()}}" data-checkedOutBooks="{{$student->checkedOutBook->toJson()}}" data-misconducts="{{$student->studentMisconduct->toJson()}}"  data-loanedBooks="{{$student->loanedBook->toJson()}}"  >
                
                <figcaption class="figure-caption" style="    text-align: center;">{{$student->name.' '.$student->surname}}</figcaption>
              </figure>
            </div>
              @endforeach
            </div>
            @endforeach