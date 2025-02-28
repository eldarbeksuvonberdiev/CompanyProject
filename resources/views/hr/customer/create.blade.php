@extends('components.layouts.app')

@section('title', 'Customer Create')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Customer Creation</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.customer.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <form action="{{ route('hr.customer.store') }}" method="post">
                @csrf
                <div class="row">
                    <label for="name" class="mb-2"><strong>
                            <h5>Customer Name:</h5>
                        </strong></label>
                    <input type="text" name="name" id="name" class="form-control mb-3" placeholder="Salary name">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="phone" class="mb-2"><strong>
                            <h5>Customers phone:</h5>
                        </strong></label>
                    <input type="text" name="phone" id="phone" class="form-control mb-3"
                        placeholder="Customers phone">
                    @error('phone')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="balance" class="mb-2"><strong>
                            <h5>Customers balance:</h5>
                        </strong></label>
                    <input type="number" name="balance" id="balance" class="form-control mb-3"
                        placeholder="Customers balance">
                    @error('balance')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label>Select Location</label>
                        <div id="map" style="height: 300px;"></div>
                    </div>

                    <!-- Latitude va Longitude yashirin maydon -->
                    <input type="hidden" id="longitude" name="longitude">
                    <input type="hidden" id="latitude" name="latitude">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-round">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>

    <!-- Yandex Maps API -->
    <script src="https://api-maps.yandex.ru/2.1/?lang=en_US" type="text/javascript"></script>
    <script>
        ymaps.ready(init);

        function init() {
            var map = new ymaps.Map("map", {
                center: [41.2995, 69.2401], // Default: Tashkent
                zoom: 13
            });

            var placemark = new ymaps.Placemark(map.getCenter(), {}, {
                draggable: true
            });
            map.geoObjects.add(placemark);

            function updateCoordinates(coords) {
                document.getElementById("latitude").value = coords[0];
                document.getElementById("longitude").value = coords[1];
            }

            placemark.events.add("dragend", function() {
                var coords = placemark.geometry.getCoordinates();
                updateCoordinates(coords);
            });

            map.events.add('click', function(e) {
                var coords = e.get('coords');
                placemark.geometry.setCoordinates(coords);
                updateCoordinates(coords);
            });
            updateCoordinates(placemark.geometry.getCoordinates());
        }
    </script>

@endsection
