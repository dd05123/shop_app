


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Exchange Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> 
    <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}">   -->
</head>

<body>
    <!-- main wrapper  -->
    <div class="wrapper">
        <!-- main-header start -->
        <header class="main-header">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="#">Link Exchange Platform</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="btn primary-btn-outline" href="{{route('instructions',['shop'=>$store])}}">Instructions</a>
                            </li>
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn primary-btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" >
                                    Fetch Store Data
                                </button> -->
                                
                                <!-- <a href="{{route('product',['shop'=>$store])}}"> <button type="button" class="btn primary-btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Fetch Store Data
                                </button></a> -->
                                <!-- <a href="{{route('blogs',['shop'=>$store])}}"> <button type="button" class="btn primary-btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Fetch Store Data
                                </button></a> -->
                                <!-- <a href="{{route('pages',['shop'=>$store])}}"> <button type="button" class="btn primary-btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Fetch Store Data
                                </button></a> -->
                                <button type="button" class="btn primary-btn" data-bs-toggle="modal"
                                    data-bs-target="#Modal">
                                    Fetch Store Data
                                </button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- header Modal start -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <img src="{{asset('assets/images/popper_img1.png')}} " class="popper-img" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Please Wait ! As it take a while for syncing app
                            with store data
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn primary-btn-outline" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- header modal end -->
        <!-- main header end -->

        <!-- main content start -->
        <main class="main-cotnent">

            <section class="pt-4 pt-xl-5">
                <!-- main tab start -->
                <div class="container">
                    <div class="tab-wrap cus-card">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="pills-search-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-search" type="button" role="tab" aria-controls="pills-search"
                                    aria-selected="true">Enable your Links</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-inbound-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-inbound" type="button" role="tab"
                                    aria-controls="pills-inbound" aria-selected="false">Inbound your link</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-outbound-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-outbound" type="button" role="tab"
                                    aria-controls="pills-outbound" aria-selected="false">Outbound Links</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <!-- search tab start -->
                            <div class="tab-pane fade" id="pills-search" role="tabpanel"
                                aria-labelledby="pills-search-tab" tabindex="0">
                                <div class="tab-content-wrap">
                                  <form action="{{ route('product_search',['shop'=>$store]) }}" method="post">
                                    <div class="input-wrap  mb-3 w-50">
                                        <label class="form-label" for="">Search</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Recipient's username"
                                                aria-label="Recipient's username" aria-describedby="button-addon2" name="search" required>
                                            <button class="btn primary-btn" type="submit"
                                                id="button-addon2">Search</button>
                                            
                                        </div>
                                    </div>
                                    </form> 
                                    <div class="table-wrap table-responsive">
                                      @yield('main')
                                        <!-- <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Desc</th>
                                                    <th class="text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Add to list</button>
                                                            <button class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#searchModal">View Details</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Add to list</button>
                                                            <button class="btn primary-btn">View Details</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Add to list</button>
                                                            <button class="btn primary-btn">View Details</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Add to list</button>
                                                            <button class="btn primary-btn">View Details</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Add to list</button>
                                                            <button class="btn primary-btn">View Details</button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table> -->
                                    </div>
                                </div>
                            </div>
                            <!-- search tab end -->

                            <!-- inbound tab start -->
                            <div class="tab-pane fade" id="pills-inbound" role="tabpanel"
                                aria-labelledby="pills-inbound-tab" tabindex="0">
                                <div class="tab-content-wrap">
                                    <label class="form-label" for=""></label>
                                    <label class="form-label" for="">How to check your DA score</label>

                                    <div class="input-group mb-3 w-50">
                                        <input type="text" class="form-control" placeholder="Add Your DA score"
                                            aria-label="Add Your DA score" aria-describedby="button-addon2">
                                        <button class="btn primary-btn" type="button" id="button-addon2">Submit</button>
                                    </div>
                                    <div class="table-wrap table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Desc</th>
                                                    <th class="text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Pending</button>
                                                            <button class="btn primary-btn">Published</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Pending</button>
                                                            <button class="btn primary-btn">Published</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td><span>Lorem i</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn-outline">Pending</button>
                                                            <button class="btn primary-btn">Published</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- inbound tab end -->

                            <!-- inbound tab strat -->
                            <div class="tab-pane fade active show" id="pills-outbound" role="tabpanel"
                                aria-labelledby="pills-outbound-tab" tabindex="0">

                                <div class="tab-content-wrap">
                                    <div class="unb-col hstack align-items-start gap-3 mb-3 ">
                                        <div class="select-wrap w-50">
                                            <select class="js-select2">
                                                <option></option>
                                                <option>Page 1</option>
                                                <option>Page 2</option>
                                                <option>Page 3</option>
                                                <option>Page 3</option>
                                            </select>
                                        </div>
                                        <div class="btn-wrap">
                                            <button class="btn primary-btn">
                                                Add outbond link
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-wrap table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Outbound Link</th>
                                                    <th scope="col">Page</th>
                                                    <th class="text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn">View Page</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn">View Page</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn">View Page</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn">View Page</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span>1</span></td>
                                                    <td><span>Lorem, ipsum.</span></td>
                                                    <td><span>Lorem, ipsum dolor.</span></td>
                                                    <td>
                                                        <div class="hstack gap-3 justify-content-center">
                                                            <button class="btn primary-btn">View Page</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- inbound tab end -->
                        </div>
                    </div>
                </div>
                <!-- manin tab end -->
            </section>
        </main>
        <!-- main content end -->

        <!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="product_model">
                         
                        </h5>
                        
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn primary-btn-outline" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        
                     <div>
                          <select  id="mySelect">
                            <option value="0">Choose The Options</option>
                            <option value="1" >Products</option>
                            <option value="2" >Blogs</option>
                            <option value="3">Pages</option>
                          </select>
                    
                        
                          <button type="button" class="btn primary-btn btn2" data-bs-toggle="modal"
                                    data-bs-target="#blogs" data-value="0" >
                                    Fetch  Data
                           </button>
                        
                        
                           <a href="{{route('product',['shop'=>$store])}}"> <button type="button" class="btn primary-btn btn1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-value="1">
                                    Fetch Data
                           </button> </a>
                        
                        
                           <a href="{{route('blogs',['shop'=>$store])}}">  <button type="button" class="btn primary-btn btn1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-value="2">
                                    Fetch Data
                           </button> </a>

                          
                           <a href="{{route('pages',['shop'=>$store])}}"> <button type="button" class="btn primary-btn btn1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-value="3">
                                    Fetch Data
                           </button> </a>
                       
                       </div> 
                        
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn primary-btn-outline" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main wrapper end -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!--popper.min.js  -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <!-- bootstrap min.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></script>


    <!-- <script src="{{asset('assets/js/jquery1.min.js')}}"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <!--popper.min.js  -->
    <!-- <script src="{{asset('assets/js/jquery2.min.js')}}"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script> -->
    <!-- bootstrap min.js -->
    <!-- <script src="{{asset('assets/js/jquery3.min.js')}}"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/jquery4.min.js')}}"></script> -->
    
    <script>
        $(document).ready(function () {
            $(".js-select2").select2({
                dropdownCssClass: "big-drop",
                placeholder: "Please select a Page"
            });
        });

        $(document).ready(function()
        {
            $ (".btn2").show();
            $ (".btn1").hide(); 
            $("select").change(function()
        {
        // alert("The text has been changed.");
          $ (".btn1").hide();
          var selectedValue = $(this).val();
          $(".btn1[data-value='" + selectedValue + "']").show();
            if(selectedValue!=="0")
            {
                $(".btn2[data-value='" +0+ "']").hide();
            }
          else
            {
                
                $(".btn2[data-value='" +0+ "']").show();
            }
        });
        $('#Modal').modal
        ({
            backdrop: 'static',
            keyboard: false
        });
        });

         $(document).ready(function(){
          $("#datatable").dataTable(); 
         });
    </script>
    @yield("footer")
</body>

</html>


