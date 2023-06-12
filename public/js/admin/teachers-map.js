$(document).ready(() => {
    mapboxgl.accessToken = 'pk.eyJ1IjoiZWxpLXNoYW1vdXQiLCJhIjoiY2t0bzFydjEzMDhmcDJybDRqOWQ2NW4xOCJ9.BOhDGTM6J1cBUPFfH5RvjQ';
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        types: 'country,region,place,postcode,locality,neighborhood'
    });

    geocoder.addTo('#map');

});