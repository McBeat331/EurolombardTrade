const departmentsLocationInMap = () => {
    var globalVariables = {
        messages: [],
    };
    var globalFunctions = {

    };
    globalFunctions.getLanguage = function () {
        return document.body.dataset.locale;
    };

    globalVariables.messages = {
        successResponse: globalFunctions.getLanguage() === 'ru' ? 'Спасибо! ваша заявка принята!' : 'Дякуємо! Ваша заявка прийнята!',
        successDescr: globalFunctions.getLanguage() === 'ru' ? 'Мы свяжемся с вами в ближайшее время.' : "Ми зв'яжемося з вами найближчим часом.",
        errorResponse: globalFunctions.getLanguage() === 'ru' ? 'Ошибка!' : 'Помилка!',
        errorResponseGadgets: globalFunctions.getLanguage() === 'ru' ? 'Для просчета стоимости рекомендуем обратиться по адресу ближайшего отделения.' : 'Для розрахунку вартості радимо звернутись за адресою найближчого відділення.',
        errorDescr: globalFunctions.getLanguage() === 'ru' ? 'Попробуйте еще раз' : 'спробуйте ще раз',
        errorDescr400: globalFunctions.getLanguage() === 'ru' ? 'Превышена максимальная сумма' : 'Перевищено максимальну суму',

        yes: globalFunctions.getLanguage() === 'ru' ? 'Да' : 'Так',
        no: globalFunctions.getLanguage() === 'ru' ? 'Нет' : 'Нi',
        gold: globalFunctions.getLanguage() === 'ru' ? 'Золото' : 'Золото',
        silver: globalFunctions.getLanguage() === 'ru' ? 'Серебро' : 'Срiбло',
        departament: globalFunctions.getLanguage() === 'ru' ? 'Отделение' : 'Відділення',

        isPhoto: globalFunctions.getLanguage() === 'ru' ? 'Необходимо добавить фото изделия' : 'Необхідно завантажити фото виробу',

        transported_to: globalFunctions.getLanguage() === 'ru' ? 'Перенесено в №' : 'Перенесено до №',
        find_nothing: globalFunctions.getLanguage() === 'ru' ? 'Ничего не найдено!' : 'Нічого не знайдено!',
        around_the_clock: globalFunctions.getLanguage() === 'ru' ? 'Круглосуточно' : 'Цілодобово',
        work_time: globalFunctions.getLanguage() === 'ru' ? 'Время работы' : 'Час роботи',
        phone:globalFunctions.getLanguage() === 'ru' ? 'Телефон' : 'Телефон',


    }

  function CreateMap(mapID) {
    this.map = null;
    this.mapDiv = document.getElementById(mapID);
    this.mapData = this.mapDiv.dataset;
    this.center = { lat: Number(this.mapData.lat), lng: Number(this.mapData.lng) };

    this.initMap = function(zoom) {
      zoom = zoom || 8;
      this.map = new google.maps.Map(this.mapDiv, {
        center: this.center,
        zoom: zoom,
        //styles:  [
        //  {"elementType": "geometry", "stylers": [{ "color": "#2f3a83"}]},/* * */
        //  {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]},
        //  {"elementType": "labels.text.fill", "stylers": [{"color": "#80b2ab"}]},/* * */
        //  {"elementType": "labels.text.stroke", "stylers": [{"color": "#212121"}]}, /* * */
        //  {"featureType": "administrative", "elementType": "geometry", "stylers": [{"color": "#80b2ab"}]},/* * */
        //  {"featureType": "administrative.country", "elementType": "labels.text.fill", "stylers": [{"color": "#9e9e9e"}]},
        //  {"featureType": "administrative.land_parcel", "stylers": [{"visibility": "off"}]},
        //  {"featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{"color": "#80b2ab"}]}, /*  */
        //  {"featureType": "poi", "elementType": "labels.text.fill", "stylers": [{"color": "#80b2ab"}]},/* * */
        //  {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#2f3e83"}]}, /*  */
        //  {"featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{"color": "#80b2ab"}]}, /*  */
        //  {"featureType": "road", "elementType": "geometry.fill", "stylers": [{"color": "#2f4b83"}]}, /*  */
        //  {"featureType": "road", "elementType": "labels.text.fill", "stylers": [{"color": "#8a8a8a"}]},
        //  {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#2f5783"}]}, /* * */
        //  {"featureType": "road.highway", "elementType": "geometry", "stylers": [{"color": "#2f4b83"}]}, /*  */
        //  {"featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [{"color": "#4e4e4e"}]},
        //  {"featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{"color": "#80b2ab"}]}, /*  */
        //  {"featureType": "transit", "elementType": "labels.text.fill", "stylers": [{"color": "#80b2ab" }]},/* * */
        //  {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#2f2483"}]},
        //  {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#3d3d3d"}]}
        //],
      });

    }
  }

  function CreateMapDepartments(mapID, locations) {
    CreateMap.apply(this, arguments);


      let infoWindows = [];
    let currentMark = null;

    this.panZoom = function() {
        console.log('qqqq');
      this.map.panTo({lat: -25.363882, lng: 131.044922});
    }
    // start setCluster
    this.setCluster = function() {
      // Start markers array
      let markers = locations.map(function(item, i) {
        let marker =  new google.maps.Marker({
          position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
          icon: '/img/marker.png'
        });
      // console.log(marker);
        // Start info Windows
        let infoWindow = new google.maps.InfoWindow({
          content: `
          <div class="lombard-map__city">${item.city_location}</div>
          <div class="lombard-map__street">${item['address_' + globalFunctions.getLanguage()]}</div>
          <div class="lombard-map__image-wrapper">
            <img class="lombard-map__image" src="${item.image_path}">
          </div>
          <div class="lombard-map__description-time">${globalVariables.messages.work_time}</div>
          <div class="lombard-map__work-time">
            ${item.hasOwnProperty('time_start') && item.time_start !== null && item.full_day === null ? item.time_start : ''} 
            ${item.hasOwnProperty('time_end') && item.time_end !== null && item.full_day === null ? '- ' + item.time_end : ''} 
            ${item.hasOwnProperty('full_day') && item.full_day !== null ? globalVariables.messages.around_the_clock : ''}
          </div>
          <div class="lombard-map__description-phone">${globalVariables.messages.phone}</div>
          <div class="lombard-map__phone">
            <a href="tel:${item.phone}">${item.phone}</a>
          </div>

          
          `,
          width: 350
        });
        infoWindows.push(infoWindow);
        let hoverInfoWindow = new google.maps.InfoWindow({
          content: `<div>${item.number}</div>`
        });
        // End info Windows

        // Start Event listeners
        google.maps.event.addListener(marker, 'click', function() {
          // console.log("click");
          for (let i=0; i < infoWindows.length; i++) {
            infoWindows[i].close();
          }
          hoverInfoWindow.close();
          infoWindow.open(this.map, marker);
          // start style image if noload
          // let $lombardMapImage = $('.lombard-map__image');
          // if( $lombardMapImage.outerWidth() < 50) {
          //   $lombardMapImage.hide();
          // }
          // end style image if noload
          currentMark = infoWindow;
          // start show close btn
          $('.lombard-map__image-wrapper').closest('.gm-style-iw').next().show();
          // end show close btn
        });

/*         google.maps.event.addListener(marker, 'mouseover', function() {
          if (currentMark) return;
          hoverInfoWindow.open(this.map, marker);
        }); */

  /*       google.maps.event.addListener(marker, 'mouseout', function() {
          hoverInfoWindow.close();
        }); */

        google.maps.event.addListener(infoWindow, 'closeclick', function() {
          currentMark = null;
        });
        // End Event listeners

        return marker;
      });
      // End markers array

    }
    // end setCluster
  }

  function CreateMapDepartment(mapID) {
    CreateMap.apply(this, arguments);

    this.setMarker = function() {
      let marker =  new google.maps.Marker({
        position: this.center,
        map: this.map,
        icon: '/img/marker.png'
      });
    }
  }

  let departmentsMap;

  function initMap(locations) {
    // console.log('initMap()');
    // departments

      (function() {
      if ( ! $('#departmentsMap').length ) return;
      departmentsMap = new CreateMapDepartments('departmentsMap', locations);
      departmentsMap.initMap();
      departmentsMap.setCluster();
    }());
    // end departments

    // department
    (function() {
      if ( ! $('#departmentMap').length ) return;
      let departmentMap = new CreateMapDepartment('departmentMap');
      departmentMap.initMap();
      departmentMap.setMarker();
    }());
    // end department
  };

  function locationZoom(location) {
    departmentsMap.panZoom(location);
  }

  // XMLHttpRequest for map's json template
  function loadLocations() {
    var lang = '';
      if(globalFunctions.getLanguage()== 'ru')
      {
          lang = '/'+globalFunctions.getLanguage();
      }
      axios.post(window.location.origin +lang+'/ajax/getCityCurrent').then(response => {
          if ($('#departmentsMap').length)
      {
          var mapDiv = document.getElementById('departmentsMap');
          mapDiv.dataset.lat = Number(response.data[0].lat);
          mapDiv.dataset.lng = Number(response.data[0].len);
      }
      initMap(response.data);
      setDepartmentsList(response.data);
      })
      .catch(error => {
              console.log(error);
      });

  };
  // End XMLHttpRequest for map's json template

    function setDepartmentsList(data) {
        let $departmentsListBlock = $('.departments-list-block');
        let itemsHTML = '';

        data.map((item) => {
            const {transportedField, phoneField, workTimeField} = makeDepartmentInfoFieldsFromItem(item);

        itemsHTML += `
                    <div class="departments-item">
    
                        <div class="departments-item__img">
                          <img src="${item.image_path}">
                        </div>
                        
                        <div class="departments-item__location departments-item__wrap">
                          <div class="departments-item__title">${ item.hasOwnProperty('city_location')  ? item.city_location : '' }</div>
                          <div class="departments-item__descr"> ${item['address_' + globalFunctions.getLanguage()]}</div>
                        </div>
    
                        <div class="departments-item__time departments-item__wrap">
                          <div class="departments-item__title">${globalVariables.messages.work_time}</div>
                          <div class="departments-item__descr">
                            ${workTimeField}
                        </div>
                        </div>
                        
                        <div class="departments-item__phone departments-item__wrap">
                          <div class="departments-item__title">${globalVariables.messages.phone}</div>
                          <div class="departments-item__descr">
                            <a href="tel:${phoneField}">${phoneField}</a>
                          </div>
                        </div>
    
                    </div>
                    `;
        });
        $departmentsListBlock.html(itemsHTML);
    };
    function makeDepartmentInfoFieldsFromItem(item) {
        const transportedField = item.transported ?
            `
            ${globalVariables.messages.transported_to}
            ${item.temporary_office.number} 
            ${item.temporary_office.hasOwnProperty('address_ru') ? item.temporary_office.address_ru : item.temporary_office.address_uk}
            `:
            '';
        const phoneField = item.transported ?
            item.temporary_office.phone :
            item.phone;
        const workTimeField = item.transported ?
            `
            ${item.temporary_office.hasOwnProperty('time_start') && item.temporary_office.time_start !== null && item.temporary_office.full_day === null ? item.temporary_office.time_start : ''} 
            ${item.temporary_office.hasOwnProperty('time_end') && item.temporary_office.time_end !== null && item.temporary_office.full_day === null ? '- ' + item.temporary_office.time_end : ''} 
            ${item.temporary_office.hasOwnProperty('full_day') && item.temporary_office.full_day !== null ? globalVariables.messages.around_the_clock : ''}
            ` :
            `
            ${item.hasOwnProperty('time_start') && item.time_start !== null && item.full_day === null ? item.time_start : ''} 
            ${item.hasOwnProperty('time_end') && item.time_end !== null && item.full_day === null ? '- ' + item.time_end : ''} 
            ${item.hasOwnProperty('full_day') && item.full_day !== null ? globalVariables.messages.around_the_clock : ''}
            `;

        return {
            transportedField,
            phoneField,
            workTimeField
        };
    }

  let $cityItems = $('#city_id');

  $cityItems.on('change', function(e) {
      let city_id = this.value;
      let lang = '';

      if (city_id!='empty') {
          if(globalFunctions.getLanguage()== 'ru')
          {
              lang = '/'+globalFunctions.getLanguage();
          }
          let mapDiv;
          axios.post(window.location.origin +lang+'/ajax/getCityCurrent').then(response => {
              if ($('#departmentsMap').length)
                  {
                      var mapDiv = document.getElementById('departmentsMap');
                      mapDiv.dataset.lat = Number(response.data[0].lat);
                      mapDiv.dataset.lng = Number(response.data[0].lng);
                  }
            initMap(response.data);
            setDepartmentsList(response.data);
          })
          .catch(error => {
              console.log(error);
          })
          ;
      }
      else {
          loadLocations();
      }
  });

  loadLocations();


}

export default departmentsLocationInMap;