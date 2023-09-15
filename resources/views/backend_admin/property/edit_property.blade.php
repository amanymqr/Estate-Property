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
                                            <select name="property_status" class="form-control " id="property_status"
                                                data-width="100%">
                                                <option disabled>Select Status</option>
                                                <option value="rent"
                                                    {{ $property->property_status === 'rent' ? 'selected' : '' }}>For Rent
                                                </option>
                                                <option value="buy"
                                                    {{ $property->property_status === 'buy' ? 'selected' : '' }}>For Buy
                                                </option>
                                            </select>

                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lowest Price </label>
                                            <input type="text" name="lowest_price" value="{{ $property->lowest_price }}"
                                                class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Max Price </label>
                                            <input type="text" name="max_price" value="{{ $property->max_price }}"
                                                class="form-control ">
                                        </div>
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
                                            <input type="text" name="garage_size" value="{{ $property->garage_size }}"
                                                class="form-control">
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
                                            <input type="text" name="postal_code" value="{{ $property->postal_code }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Size</label>
                                            <input type="text" name="property_size" value="{{ $property->garage }}"
                                                class="form-control">
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
                                            <input type="text" name="longitude" value="{{ $property->longitude }}"
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
                                            <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
                                                <option disabled>Select Type</option>
                                                @foreach ($propertyType as $ptype)
                                                    <option value="{{ $ptype->id }}"
                                                        {{ old('ptype_id', $property->ptype_id) == $ptype->id ? 'selected' : '' }}>
                                                        {{ $ptype->type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                    {{--  property_ami  --}}
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Amenities</label>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                                multiple="multiple" data-width="100%">
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
                                            <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
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

                                {{--  //image thum  --}}
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Edit Main Thambnail Image </h6>
                                            <input type="hidden" name="old_img"
                                                value="{{ $property->property_thambnail }}">
                                            <div class="row mb-3">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Edit Main Thambnail </label>
                                                    <input type="file" name="property_thambnail"
                                                        value="{{ old('property_thambnail') }}" class="form-control"
                                                        onchange="mainThamUrl(this)">
                                                    <img src="" id="mainThmb">
                                                </div>
                                                <div class="mb-3 form-group col-md-6">
                                                    <label class="form-label"></label>
                                                    <img src="{{ asset($property->property_thambnail) }}"
                                                        style="width: 100px ;">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                {{--  //multi thum  --}}
                                <div class="row mt-4">
                                    <div class="col-lg-12 ">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Edit Multi Images </h4>

                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th>Sl</th>
                                                            <th>Image</th>
                                                            <th>Change Image </th>
                                                            <th>Delete </th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($multiImage as $key => $img)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td class="py-1">
                                                                        <img src="{{ asset($img->photo_name) }}"
                                                                            alt="image">
                                                                    </td>
                                                                    <td>
                                                                        <input type="file" class="form-control"
                                                                            name="multi_img[{{ $img->id }}]">
                                                                    </td>
                                                                    <td>

                                                                        <div class="image-container" id="deleteForm">
                                                                            {{--  <img src="{{ asset($img->photo_name) }}"
                                                                                alt="Multi-image">  --}}
                                                                            <a href="{{ route('property.multiimg.delete', ['id' => $property->id, 'multiId' => $img->id]) }}"
                                                                                class="btn btn-danger">Delete</a>
                                                                        </div>


                                                                    </td>
                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100  m-3">Edit Property</button>

                            </form>

                            <form method="post" class="mb-3"
                                action="{{ route('store.new.multiimage', ['property' => $property->id]) }}"
                                id="myForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="imageid" value="{{ $property->id }}">
                                {{--  <input type="file" name="multi_img" id="multi_img">  --}}

                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="file" class="form-control" name="multi_img">
                                            </td>

                                            <td>
                                                <input type="submit" class="btn btn-info px-4" value="Add Image">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
