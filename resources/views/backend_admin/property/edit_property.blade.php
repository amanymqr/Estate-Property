@extends('admin.admin_dashboard')
@section('title', 'Add Property ')
@section('content')
    <div class="page-content">

        <div class="row profile-body">
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Property </h6>
                            {{--  <form method="POST" action="{{ route('property.update', ['property' => $property->id]) }}" enctype="multipart/form-data" id="myForm" class="forms-sample">
                                @csrf
                                @method('PUT')  --}}
                            <form method="POST" action="{{ route('property.update', ['property' => $property->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name"
                                                class="form-control @error('property_name') is-invalid @enderror"
                                                value="{{ $property->property_name }}">
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
                                                id="property_status" data-width="100%">
                                                <option disabled>Select Status</option>
                                                <option value="rent"
                                                    {{ $property->property_status === 'rent' ? 'selected' : '' }}>For Rent
                                                </option>
                                                <option value="buy"
                                                    {{ $property->property_status === 'buy' ? 'selected' : '' }}>For Buy
                                                </option>
                                            </select>
                                            @error('property_status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lowest Price </label>
                                            <input type="text" name="lowest_price" value="{{ $property->lowest_price }}"
                                                class="form-control  @error('lowest_price') is-invalid @enderror">
                                            @error('lowest_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Max Price </label>
                                            <input type="text" name="max_price" value="{{ $property->max_price }}"
                                                class="form-control  @error('max_price') is-invalid @enderror">
                                            @error('max_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">BedRooms</label>
                                                <input type="number" name="bedrooms" value="{{ $property->bedrooms }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Bathrooms</label>
                                                <input type="number" name="bathrooms" value="{{ $property->bathrooms }}"
                                                    class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Garage</label>
                                                <input type="text" name="garage" value="{{ $property->garage }}"
                                                    class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Garage Size</label>
                                                <input type="text" name="garage_size"
                                                    value="{{ $property->garage_size }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" value="{{ $property->address }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" value="{{ $property->city }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <input type="text" name="state" value="{{ $property->state }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label class="form-label">Postal Code </label>
                                                <input type="text" name="postal_code"
                                                    value="{{ $property->postal_code }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Size</label>
                                                <input type="text" name="property_size"
                                                    value="{{ $property->garage }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Video</label>
                                                <input type="text" name="property_video"
                                                    value="{{ $property->property_video }}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Neighborhood</label>
                                                <input type="text" name="neighborhood"
                                                    value="{{ $property->neighborhood }}" class="form-control">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="text" name="latitude" value="{{ $property->latitude }}"
                                                    class="form-control">
                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                    target="_blank">Go here to get Latitude from address</a>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="text" name="longitude"
                                                    value="{{ $property->longitude }}" class="form-control">
                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                    target="_blank">Go here to get Longitude from address</a>

                                            </div>
                                        </div>




                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Type</label>
                                                <select name="ptype_id"
                                                    class="form-select @error('ptype_id') is-invalid @enderror"
                                                    id="exampleFormControlSelect1">
                                                    <option disabled>Select Type</option>
                                                    @foreach ($propertyType as $ptype)
                                                        <option value="{{ $ptype->id }}"
                                                            {{ old('ptype_id', $property->ptype_id) == $ptype->id ? 'selected' : '' }}>
                                                            {{ $ptype->type_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ptype_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                        </div>
                                        {{--  property_ami  --}}
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Property Amenities</label>
                                                <select name="amenities_id[]"
                                                    class="js-example-basic-multiple form-select" multiple="multiple"
                                                    data-width="100%">
                                                    @foreach ($amenities as $amenities)
                                                        <option value="{{ $amenities->id }}"
                                                            {{ in_array($amenities->id, $property_ami) ? 'selected' : '' }}>
                                                            {{ $amenities->amenitis_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Agent</label>
                                                <select name="agent_id" class="form-select"
                                                    id="exampleFormControlSelect1">
                                                    <option disabled>Select Agent</option>
                                                    @foreach ($activeAgent as $agent)
                                                        <option value="{{ $agent->id }}"
                                                            {{ $agent->id == $property->agent_id ? 'selected' : '' }}>
                                                            {{ $agent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Short Description</label>
                                                <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $property->short_descp }}</textarea>

                                            </div>
                                        </div>

                                        {{--  {{ dd($property) }}  --}}


                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Long Description</label>

                                                <textarea name="long_descp" class="form-control" name="tinymce" id="tinymceExample" rows="10">{!! $property->long_descp !!}</textarea>

                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input name="featured" value="1" type="checkbox"
                                                    class="form-check-input" id="checkInline1"
                                                    {{ $property->featured == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checkInline1">
                                                    Featured Property
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="hot" value="1"
                                                    class="form-check-input" id="checkInline2"
                                                    {{ $property->hot == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checkInline2">
                                                    Hot Property
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    {{--  Facilities  --}}

                                    <button type="submit" class="btn btn-primary  mt-3">Edit Property</button>

                            </form>
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
