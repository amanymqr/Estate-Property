@extends('agent.agent_dashboard')
@section('title', 'Add Property ')
@section('content')
    <div class="page-content">

        <div class="row profile-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Property </h6>
                            <form method="POST" action="{{ route('agent_property.store') }}" enctype="multipart/form-data"
                                id="myForm" class="forms-sample">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name"
                                                class="form-control @error('property_name') is-invalid @enderror"
                                                value="{{ old('property_name') }}">
                                            @error('property_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Status</label>
                                            <select name="property_status"
                                                class="form-control @error('property_status') is-invalid @enderror"
                                                id="property_status" value="{{ old('property_status') }} data-width="100%">
                                                <option selected disabled>Selecte Status </option>
                                                <option value="rent">for rent </option>
                                                <option value="buy">for Buy </option>
                                            </select>
                                            @error('property_status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lowest Price </label>
                                            <input type="text" name="lowest_price" value="{{ old('lowest_price') }}"
                                                class="form-control  @error('lowest_price') is-invalid @enderror">
                                            @error('lowest_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Max Price </label>
                                            <input type="text" name="max_price" value="{{ old('max_price') }}"
                                                class="form-control  @error('max_price') is-invalid @enderror">
                                            @error('max_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label">Main Thambnail </label>
                                            <input type="file" name="property_thambnail"
                                                value="{{ old('property_thambnail') }}"
                                                class="form-control @error('property_thambnail') is-invalid @enderror"
                                                onchange="mainThamUrl(this)">
                                            <img src="" id="mainThmb">
                                            @error('property_thambnail')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label">Multiple Image </label>
                                            <input type="file" name="multi_img[]" value="{{ old('multi_img') }}"
                                                class="form-control @error('multi_img') is-invalid @enderror" id="multiImg"
                                                multiple="">
                                            @error('multi_img')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="row" id="preview_img"> </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">BedRooms</label>
                                                <input type="number" name="bedrooms" value="{{ old('bedrooms') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Bathrooms</label>
                                                <input type="number" name="bathrooms" value="{{ old('bathrooms') }} "
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Garage</label>
                                                <input type="text" name="garage" value="{{ old('garage') }}"
                                                    class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Garage Size</label>
                                                <input type="text" name="garage_size" value="{{ old('garage_size') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" value="{{ old('address') }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" value="{{ old('city') }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <select name="state" class="form-select"
                                                    id="exampleFormControlSelect1">
                                                    <option selected="" disabled="">Select State</option>
                                                    @foreach ($property_state as $state)
                                                        <option value="{{ $state->id }}">{{ $state->state_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Postal Code </label>
                                                <input type="text" name="postal_code"
                                                    value="{{ old('postal_code') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Size</label>
                                                <input type="text" name="property_size"
                                                    value="{{ old('property_size') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Video</label>
                                                <input type="text" name="property_video"
                                                    value="{{ old('property_video') }}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Neighborhood</label>
                                                <input type="text" name="neighborhood"
                                                    value="{{ old('neighborhood') }}" class="form-control">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="text" name="latitude" value="{{ old('latitude') }}"
                                                    class="form-control">
                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                    target="_blank">Go here to get Latitude from address</a>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="text" name="longitude" value="{{ old('Longitude') }}"
                                                    class="form-control">
                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                    target="_blank">Go here to get Longitude from address</a>

                                            </div>
                                        </div>




                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Type</label>
                                                <select name="ptype_id" value="{{ old('ptype_id') }}"
                                                    class="form-select @error('ptype_id') is-invalid @enderror"
                                                    id="exampleFormControlSelect1">
                                                    <option selected disabled>Select Type</option>
                                                    @foreach ($propertyType as $ptype)
                                                        <option value="{{ $ptype->id }}">{{ $ptype->type_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ptype_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Amenities </label>
                                                <select name="amenities_id[]"
                                                    class="js-example-basic-multiple form-select" multiple="multiple"
                                                    data-width="100%">
                                                    @foreach ($amenities as $amenities)
                                                        <option value="{{ $amenities->amenities_name }}">
                                                            {{ $amenities->amenities_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Short Descrition</label>
                                                <textarea class="form-control" name="short_descp" id="short_descp" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Short Descrition</label>
                                                <textarea class="form-control" name="long_descp" id="tinymceExample" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input name="featured" value="1" type="checkbox"
                                                    class="form-check-input" id="checkInline1">
                                                <label class="form-check-label" for="checkInline1">
                                                    Featured Property
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="hot" value="1"
                                                    class="form-check-input" id="checkInline2">
                                                <label class="form-check-label" for="checkInline2">
                                                    Hot Property
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    {{--  Facilities  --}}
                                    <div class="row add_item">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="facility_name" class="form-label">Facilities </label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                    <option value="">Select Facility</option>
                                                    <option value="Hospital">Hospital</option>
                                                    <option value="SuperMarket">Super Market</option>
                                                    <option value="School">School</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Airport">Airport</option>
                                                    <option value="Railways">Railways</option>
                                                    <option value="Bus Stop">Bus Stop</option>
                                                    <option value="Beach">Beach</option>
                                                    <option value="Mall">Mall</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="distance" class="form-label"> Distance </label>
                                                <input type="text" name="distance[]" id="distance"
                                                    class="form-control" placeholder="Distance (Km)">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4" style="padding-top: 30px;">
                                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                                More..</a>
                                        </div>
                                    </div> <!---end row-->

                                    <button type="submit" class="btn btn-primary  mt-3">Add Property</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="facility_name">Facilities</label>
                            <select name="facility_name[]" id="facility_name" class="form-control">
                                <option value="">Select Facility</option>
                                <option value="Hospital">Hospital</option>
                                <option value="SuperMarket">Super Market</option>
                                <option value="School">School</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Airport">Airport</option>
                                <option value="Railways">Railways</option>
                                <option value="Bus Stop">Bus Stop</option>
                                <option value="Beach">Beach</option>
                                <option value="Mall">Mall</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="distance">Distance</label>
                            <input type="text" name="distance[]" id="distance" class="form-control"
                                placeholder="Distance (Km)">
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                    class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--========== End of add multiple class with ajax ==============-->
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
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
