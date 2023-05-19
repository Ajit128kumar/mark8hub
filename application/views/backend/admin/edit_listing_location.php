<!--<div class="form-group">-->
<!--  <label for="country_id" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?> <span style="color:red;">*</span></label>-->

<!--  <div class="col-sm-7">-->
<!--    <select name="country_id" id = "country_id" class="select2" data-allow-clear="true" data-placeholder="<?php echo get_phrase('select_country'); ?>" onchange="getCityList(this.value)">-->
<!--      <option value="0"><?php echo get_phrase('none'); ?></option>-->
<!--      <?php foreach ($countries as $country): ?>-->
<!--          <option value="<?php echo $country['id']; ?>" <?php if($listing_details['country_id'] == $country['id']): ?> selected <?php endif;?>><?php echo $country['name']; ?></option>-->
<!--      <?php endforeach; ?>-->
<!--    </select>-->
<!--  </div>-->
<!--</div>-->

<!--<div class="form-group">-->
<!--  <label class="col-sm-3 control-label" for="city_id"> <?php echo get_phrase('city'); ?> <span style="color:red;">*</span></label>-->
<!--  <div class="col-sm-7">-->
<!--    <select class="form-control select2" name="city_id" id="city_id">-->
<!--      <?php foreach ($this->crud_model->get_cities_by_country_id($listing_details['country_id'])->result_array() as $city): ?>-->
<!--          <option value="<?php echo $city['id']; ?>" <?php if($listing_details['city_id'] == $city['id']): ?> selected <?php endif;?>><?php echo $city['name']; ?></option>-->
<!--      <?php endforeach; ?>-->
<!--    </select>-->
<!--  </div>-->
<!--</div>-->

<div class="form-group">
  <label class="col-sm-3 control-label" for="address"><?php echo get_phrase('address'); ?></label>
  <div class="col-sm-7">
        <input type="text" name="address" id="pac-input" value="<?= $listing_details['address']; ?>" class="form-control"/>
  </div>
</div>

<div id="map" style=" height: 350px; margin-bottom: 20px; position: relative; overflow: hidden;"></div>

<div class="form-group">
  <label class="col-sm-3 control-label" for="latitude"><?php echo get_phrase('latitude'); ?> <span style="color:red;">*</span></label>
  <div class="col-sm-7">
    <input type="text" class="form-control lattitude" id="lattitude" name="latitude" value="<?= $listing_details['latitude'] ?>"/>
    
  </div>
</div>

<div class="form-group row mb-3">
  <label class="col-sm-3 control-label" for="longitude"><?php echo get_phrase('longitude'); ?><span style="color:red;">*</span></label>
  <div class="col-md-7">
    <input type="text" class="form-control lonngitude" id="longitude" name="longitude" value="<?= $listing_details['longitude'] ?>" />
  </div>
</div>

       <div id="map" style="height: 300px;"></div>

<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css"/>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>-->
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-izr7XK6g2OdUqO0nWPDivtlv-xSxu1E&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
<script>
var lat = <?= $listing_details['latitude'] ?>; 
var lngg = <?= $listing_details['longitude'] ?>;
const title = document.getElementById("pac-input");
    function initAutocomplete() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: lat, lng: lngg },
    zoom: 18,
    mapTypeId: "roadmap",
  });
 new google.maps.Marker({
          map,
          title: title,
          position: { lat: lat, lng: lngg },
          draggable: true,
          zoom:18
        })
  // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);

//   map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  let markers = [];

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();
    var latitude = places[0].geometry.location.lat();
    var longitude = places[0].geometry.location.lng();
    // $("#lattitude").val(latitude.toString());
    document.getElementById("lattitude").value = latitude.toString();
    $("#longitude").val(longitude);
  
    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }

      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };

      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
          draggable: true,
        })
      );
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}
</script>

<script type="text/javascript">
    
    // var map = L.map('map', {center : mapCenter, zoom : 18});

    <?php if(get_settings("active_map") == 'openstreetmap'): ?>
    //free maps
    // L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png', {
    //     attribution: 'Select Your Place',
    //     minZoom: '<?= get_settings("min_zoom_level"); ?>',
    //     maxZoom: '<?= get_settings("max_zoom_level"); ?>',
    // }).addTo(map);
    <?php else: ?>
    //paid maps
    // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    //     attribution: 'Select Your Place',
    //     minZoom: '<?= get_settings("min_zoom_level"); ?>',
    //     maxZoom: '<?= get_settings("max_zoom_level"); ?>',
    //     id: 'mapbox/streets-v11',
    //     style: 'mapbox://styles/mapbox/streets-v11',
    //     accessToken: '<?= get_settings("map_access_token"); ?>'

    // }).addTo(map);
    <?php endif; ?>

    // $(document).ready(function() {
    //     setTimeout(() => {
    //         map.invalidateSize();
    //     }, 0);
    // });


    // var marker = L.marker(mapCenter).addTo(map);
    // var updateMarker = function(lat, lng) {
    //     marker
    //         .setLatLng([lat, lng])
    //         .bindPopup("Your location :  " + marker.getLatLng().toString())
    //         .openPopup();
    //     return false;
    // };

    // map.on('click', function(e) {
    //     $('#latitude').val(e.latlng.lat);
    //     $('#longitude').val(e.latlng.lng);
    //     updateMarker(e.latlng.lat, e.latlng.lng);
    // });

    // var updateMarkerByInputs = function() {
    //     return updateMarker( $('#latitude').val() , $('#longitude').val());
    // }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
</script>

