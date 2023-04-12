@extends('layouts.app')

@section('content')
    <br>
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item active text-success myInput" aria-current="page">Book Adjustment</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <br>
        
        <div class="d-flex mb-1 ">
            <div class="me-auto p-2"> 
        </div>

        <div class="p-2"> <div class="input-group">                              
            <input type="search" class="form-control rounded myInput" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>                
         </div></div>
        </div>
        <table class="table table-bordered myTable">
            <thead>
                <tr class="bg-success text-white">
                    <th scope="col"  class="text-center">BOOK ID</th>
                    <th scope="col"  class="text-center">ISBN</th>
                    <th scope="col"  class="text-center">BOOK TITLE</th>
                    <th scope="col"  class="text-center">AUTHOR/S</th>
                    <th scope="col"  class="text-center">DATE PUBLISH</th>
                    <th scope="col"  class="text-center">PUBLISHER</th>
                    <th scope="col"  class="text-center">GENRE</th>
                    <th scope="col"  class="text-center">COPIES</th>
                    <th scope="col"  class="text-center">ADDED DATE</th>
                    <th scope="col" class="text-center">ACTIONS PERFORM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                        <th class="px-6 py-3">
                            {{ $book->id }}
                        </th>
                        <td class="px-6 py-3">
                            {{ $book->isbn }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $book->booktitle }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $book->author }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $book->datepublish }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $book->publisher }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $book->genre }}
                        </td>
                        <td class="px-6 py-3">
                            {{$book->numberofcopies()}}
                        </td>

                        <td class="px-6 py-3">
                            {{ $book->created_at }}
                        </td>
                        <td>              
                            {{-- button --}}
                            <button type="button" class="btn btn-success edit-button" data-id={{ $book->id }}
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                            </button>

                            <button type="button" class="btn btn-danger edit-button" data-bs-toggle="modal" data-id={{ $book->id }}
                                data-bs-target="#back"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                  </svg></button>  
                                </td>
                            {{-- modal --}}          
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">AJUST COPIES</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        {{-- MODAL BODY --}}                      
                                        <div class="modal-body ">
                                            <form method="POST" action="{{ route('books.update-copy') }}">
                                                
                                                <fieldset>
                                                    <div class="mb-3">                   
                                                        <label for="disabledTextInput" class="form-label">BOOK ID</label>
                                                        <input type="text" id="disabledTextInput"
                                                            class="form-control modal-book-id" placeholder="Disabled input" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">BOOK TITLE</label>
                                                        <input type="text" id="disabledTextInput"
                                                            class="form-control modal-book-title"
                                                            placeholder="Disabled input" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">AUTHOR/S</label>
                                                        <input type="text" id="disabledTextInput" class="form-control modal-book-author"
                                                            placeholder="Disabled input" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">DATE
                                                            PUBLISH</label>
                                                        <input type="text" id="disabledTextInput" class="form-control modal-book-datepublish"
                                                            placeholder="Disabled input" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">PUBLISHER</label>
                                                        <input type="text" id="disabledTextInput" class="form-control modal-book-publisher"
                                                            placeholder="Disabled input" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">AVAILABLE
                                                            COPIES</label>
                                                        <input type="text" id="" class="form-control modal-copy-copies"
                                                            placeholder="" readonly>
                                                    </div>
                                                </fieldset>
                                                <div class="mb-3">
                                                    <label for="addcopies" class="form-label">ADD NEW COPIES</label>
                                                    <input type="hidden" name="bookid" class="modal-book-id">
                                                    <input input type="text" class="form-control" id="addcopies" name="addcopies" :value="old('addcopies')"
                                                        placeholder="ex.10">
                                                </div>
                                                @if (session('Error'))              
                                                <div class="alert alert-danger">
                                                    {{ session('Error') }}                             
                                                </div>                                    
                                                @endif
                                        </div>
                                   
                                        <div class="modal-footer">           
                                            @csrf
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Add copies</button>
                                        </div>
                                    </form>
                                    </div>
                                </div> 
                            </div>
                            

                            {{-- button --}}
                     

                               {{-- modal --}}          
                               <div class="modal fade" id="back" data-bs-backdrop="static" data-bs-keyboard="false"
                               tabindex="-1" aria-labelledby="backrop" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h1 class="modal-title fs-5" id="back">ADJUST COPIES</h1>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal"
                                               aria-label="Close"></button>
                                       </div>
                                       {{-- MODAL BODY --}}                      
                                       <div class="modal-body ">
                                           <form method="POST" action="{{ route('books.updatenegative-copy') }}">                      
                                               <fieldset>
                                                   <div class="mb-3">                   
                                                       <label  class="form-label">BOOK ID</label>
                                                       <input type="text" id="disabledTextInput"
                                                           class="form-control modal-book-id" readonly>
                                                   </div>
                                                   <div class="mb-3">
                                                       <label  class="form-label">BOOK TITLE</label>
                                                       <input type="text" id="disabledTextInput"
                                                           class="form-control modal-book-title"
                                                            readonly>
                                                   </div>
                                                   <div class="mb-3">
                                                       <label  class="form-label">AUTHOR/S</label>
                                                       <input type="text" id="disabledTextInput" class="form-control modal-book-author"
                                                            readonly>
                                                   </div>
                                                   <div class="mb-3">
                                                    <label for="" class="form-label">AVAILABLE
                                                        COPIES</label>
                                                    <input type="text" id="" class="form-control modal-copy-copies"
                                                        placeholder="" readonly>
                                                </div>
                                                   <div class="mb-3">
                                                       <label  class="form-label">YEAR OF
                                                           PUBLISH</label>
                                                       <input type="text" id="disabledTextInput" class="form-control modal-book-datepublish"
                                                            readonly>
                                                   </div>                                      
                                               <div class="mb-3">
                                                <label for="lesscopies" class="form-label">LESS COPIES</label>
                                                <input type="hidden" name="bookid" class="modal-book-id">
                                                <input input type="text" class="form-control" id="lesscopies" name="lesscopies" :value="old('lesscopies')"
                                                    placeholder="ex.10">
                                               </div>
                                               @if (session('Error'))              
                                               <div class="alert alert-danger">
                                                   {{ session('Error') }}                             
                                               </div>                                    
                                               @endif
                                               <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">REASON</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                              </div>
                                            </fieldset>
                                       </div>
                                    {{-- footermodal --}}
                                       <div class="modal-footer">           
                                           @csrf
                                           <button type="button" class="btn btn-danger"
                                               data-bs-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-success">Less copies</button>
                                       </div>
                                   </form>
                                   {{-- end of form --}}
                                   </div>
                               </div> 
                           </div> 
                           {{-- end of div --}}
                       
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>

        </table>
        
        <div class="d-flex justify-content-center">
            {{ $books->links() }}
          </div>
        <br>
        <br>
        
    </div>
  

@endsection
