@extends('admin.admin_dashboard')
@section('title', 'Add Property ')
@section('content')
    <div class="page-content">

        <div class="row profile-body">


            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Property </h6>
                            <form method="POST" action="{{ route('property.store') }}" class="forms-sample">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name" class="form-control"
                                                placeholder="Enter first name">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Status</label>
                                            <select name="ptype_id" class="form-select"
                                                id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Status</option>
                                                    @foreach ($propertyType as $ptype )
                                                    <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>

                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lowest Price </label>
                                            <input type="text" name="lowest_price" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Max Price </label>
                                            <input type="text" name="max_price" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Main Thambnail </label>
                                            <input type="file" name="property_thambnail" class="form-control"
                                                onchange="mainThamUrl(this)">
                                            <img src="" id="mainThmb">

                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Multiple Image </label>
                                            <input type="file" name="multi_img[]" class="form-control" id="multiImg"
                                                multiple="">
                                        </div>
                                        <div class="row" id="preview_img"> </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">BedRooms</label>
                                                <input type="number" name="bedrooms" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Bathrooms</label>
                                                <input type="number" name="bathrooms" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Garage</label>
                                                <input type="text" name="garage" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Garage Size</label>
                                                <input type="text" name="garage_size" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <input type="text" name="state" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Postal Code </label>
                                                <input type="text" name="postal_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Size</label>
                                                <input type="text" name="property_size" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Video</label>
                                                <input type="text" name="property_video" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Neighborhood</label>
                                                <input type="text" name="neighborhood" class="form-control">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="text" name="latitude" class="form-control">
                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                    target="_blank">Go here to get Latitude from address</a>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="text" name="longitude" class="form-control">
                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                    target="_blank">Go here to get Longitude from address</a>

                                            </div>
                                        </div>




                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Type </label>
                                                <input type="text" name="property_type" class="form-control">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Amenities </label>
                                                <input type="text" name="property_amenities" class="form-control">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Agent </label>
                                                <input type="text" name="agent" class="form-control">
                                            </div>
                                        </div><!-- Col -->


                                    </div>


                            </form>
                            <button type="button" class="btn btn-primary submit">Submit form</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@section('scripts')


    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

@endsection
@stop
