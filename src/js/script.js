let userPosition;

function getPosition(position) {
  userPosition = ([position.coords.latitude, position.coords.longitude]);
}

if('geolocation' in navigator) {
  navigator.geolocation.getCurrentPosition(getPosition);
}

const map = L.map('map').setView([0, 0], 4);

setTimeout(() => {
  L.marker(userPosition).addTo(map);
}, 3000);

L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=YgPAT9ATg8pEvFordyhg', {
  attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
}).addTo(map);

let trilha = new L.geoJSON().addTo(map);

map.on('click', (e) => {
  const from = `${userPosition[0]}, ${userPosition[1]}`;
  const to = `${e.latlng.lat},${e.latlng.lng}`;
  
  fetch(`https://graphhopper.com/api/1/route?point=${from}&point=${to}&vehicle=car&points_encoded=false&key=60eed1a4-e582-4303-81c9-36330658c9bc`)
    .then(res => {
      return res.json();
    })
    .then(data => {
      const distance = data.paths[0].distance / 1000
      const time = data.paths[0].time / 60000
      const popup = L.popup(e.latlng)
        .setLatLng(e.latlng)
        .setContent(`<p>Distância: ${distance.toFixed(2)}km<br/><br/>De carro você levará aproximadamente ${(time / 60).toFixed(2)}H para chegar ao seu destino</p>`)
        .openOn(map);
      
      const myLines = [{
        "type": "LineString",
        "coordinates": data.paths[0].points.coordinates
      }];
      
      trilha.addData(myLines);
    })
    .catch(err => {
      const popup = L.popup(e.latlng)
        .setLatLng(e.latlng)
        .setContent(`<h1>Houve um ero, tente marcar outro local!</h1>`)
        .openOn(map);
    });
});
