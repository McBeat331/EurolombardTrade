window._ = require('lodash');

$(document).ready(function () {

    let city = $('#city_id');
    let department = $('#department');
    let departmentsMap;

    if ($('#departmentMap').length) initMap();

    function getAllItems() {
        if ($('#departmentsMap').length === 0) return;

        axios.get(window.location.origin + window.location.pathname + '/get-departments')
            .then(response => {
                initMap(response.data);
                setDepartmentsList(response.data);
            })
            .catch(error => {
                console.log(error);
            })

    }

    getAllItems();

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
                      <div class="departments-item__title">№${ item.hasOwnProperty('city_location')  ? item.city_location : '' }</div>
                      <div class="departments-item__descr">, ${ item.hasOwnProperty('street_type_ru')  ? item.street_type_ru : item.street_type_uk } ${ item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk }</div>
                    </div>

                    <div class="departments-item__time departments-item__wrap">
                      <div class="departments-item__title">${globalVariables.messages.work_time}</div>
                      <div class="departments-item__descr">
                        ${transportedField}
                        ${item['work_days_' + globalFunctions.getLanguage()]} 
                        ${workTimeField} 
                    </div>
                    </div>
                    
                    <div class="departments-item__phone departments-item__wrap">
                      <div class="departments-item__title">Телефон</div>
                      <div class="departments-item__descr">
                        <a href="tel:${phoneField}">${phoneField}</a>
                      </div>
                    </div>

                </div>
                `;
        });        
        $departmentsListBlock.html(itemsHTML);
    };

    city.chosen().change(function () {
        let city_id = city.chosen().val();
        if (city_id !== 'national') {
            axios.get(window.location.origin + window.location.pathname + '/get-departments?city=' + city_id)
                .then(response => {
                    setFetchedDepartmentsToChosenSelect(response);
                    initMap(response.data);     
                    setDepartmentsList(response.data);          
                })
                .catch(error => {
                    console.log(error);
                });
        } else {
            getAllItems();
        }
    });

    department.chosen().change(function () {
        let city_id = city.chosen().val();
        let department_id = department.chosen().val();
        if (department_id !== 'all') {
            axios.get(window.location.origin + window.location.pathname + '/get-departments?city=' + city_id + '&department=' + department_id)
                .then(response => {
                    _.map(response.data, function (item) {
                        departmentsMap.panZoom({lat: parseFloat(item.lat), lng: parseFloat(item.lng)});
                    });
                    departmentsMap.zoom(18);
                    setDepartmentsList(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        } else {
            departmentsMap.zoom(8);
            axios.get(window.location.origin + window.location.pathname + '/get-departments?city=' + city_id)
                .then(response => {
                    setDepartmentsList(response.data);          
                })
                .catch(error => {
                    console.log(error);
                });
        }
    });

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
            ${item.temporary_office.hasOwnProperty('full_day') && item.temporary_office.full_day !== null ? ' Круглосуточно' : ''}
            ` :
            `
            ${item.hasOwnProperty('time_start') && item.time_start !== null && item.full_day === null ? item.time_start : ''} 
            ${item.hasOwnProperty('time_end') && item.time_end !== null && item.full_day === null ? '- ' + item.time_end : ''} 
            ${item.hasOwnProperty('full_day') && item.full_day !== null ? ' Круглосуточно' : ''}
            `;
        
        return {
            transportedField,
            phoneField,
            workTimeField
        };
    }

    function setFetchedDepartmentsToChosenSelect(response) {
        if (response) {
            clear();
            _.map(response.data, function (item) {
                const {transportedField, phoneField, workTimeField} = makeDepartmentInfoFieldsFromItem(item);

                department.append(
                    `<option value="${item.id}">
                        № ${item.number} ${item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk} ${ item.hasOwnProperty('street_type_ru')  ? item.street_type_ru : item.street_type_uk } 
                        ${transportedField} 
                        ${phoneField} 
                        ${workTimeField} 
                    </option>`
                );
            });

            department.trigger("chosen:updated");
        }
    }

    function clear() {
        department.empty();
        department.append('<option value="all">' + department.data('all') + '</option>');
    }

    function CreateMap(mapID) {
        if (typeof google !== 'undefined') {

            let current_location;
            navigator.geolocation.getCurrentPosition(function (position) {
                current_location = {lat: position.coords.latitude, lng: position.coords.longitude};
            });

            this.map = null;
            this.mapDiv = document.getElementById(mapID);
            this.mapData = this.mapDiv.dataset;
            this.center = {lat: parseFloat(this.mapData.lat), lng: parseFloat(this.mapData.lng)};

            this.initMap = function (zoom) {
                zoom = zoom || 8;
                this.map = new google.maps.Map(this.mapDiv, {
                    center: this.center,
                    zoom: zoom,
                });
            };
        }
    }

    function CreateMapDepartments(mapID, locations) {
        CreateMap.apply(this, arguments);

        let infoWindows = [];
        let currentMark = null;

        this.panZoom = function (location) {
            this.map.panTo(location);
        },

            this.zoom = function (zoom) {
                this.map.setZoom(zoom)
            },

            // start setCluster
            this.setCluster = function () {
                // Start markers array
                let markers = locations.map(function (item, i) {

                    let marker = new google.maps.Marker({
                        position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                        icon: '/img/marker.png'
                    });

                    // Start info Windows
                    let infoWindow = new google.maps.InfoWindow({
                        content: item.image_path !== null ? `
                      <div class="lombard-map__image-wrapper">
                        <img class="lombard-map__image" src="${item.image_path}">
                      </div>
                      <div class="lombard-map__number">№ ${item.number}</div>
                      <div class="lombard-map__location">${ item.hasOwnProperty('street_type_ru')  ? item.street_type_ru : item.street_type_uk } ${ item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk }</div>
                      <div class="lombard-map__phone">
                        <a href="tel:${item.phone}">${item.phone}</a>
                      </div>
                      <div class="lombard-map__work-time">${item.hasOwnProperty('work_days_ru') && item.work_days_ru !== null ? item.work_days_ru +', ' : '' } ${item.hasOwnProperty('work_days_uk') && item.work_days_uk !== null ? item.work_days_uk : '' } ${item.hasOwnProperty('time_start') && item.time_start !== null && item.full_day === null ? ' ' +item.time_start : '' } ${item.hasOwnProperty('time_end') && item.time_end !== null && item.full_day === null ? ' - ' + item.time_end : '' } ${item.hasOwnProperty('full_day') && item.full_day !== null ? ' Круглосуточно ' : '' }</div>
                      <a href="${item.link}" class="lombard-map__link">${item.details}</a>
                      `
                            :
                      `<div class="lombard-map__number">№ ${item.number}</div>
                      <div class="lombard-map__location">${ item.hasOwnProperty('street_type_ru')  ? item.street_type_ru : item.street_type_uk } ${ item.hasOwnProperty('address_ru')  ? item.address_ru : item.address_uk }</div>
                      <div class="lombard-map__phone">
                        <a href="tel:${item.phone}">${item.phone}</a>
                      </div>
                      <div class="lombard-map__work-time">${item.hasOwnProperty('work_days_ru') && item.work_days_ru !== null ? item.work_days_ru +', ' : '' } ${item.hasOwnProperty('work_days_uk') && item.work_days_uk !== null ? item.work_days_uk : '' } ${item.hasOwnProperty('time_start') && item.time_start !== null && item.full_day === null ? ' ' +item.time_start : '' } ${item.hasOwnProperty('time_end') && item.time_end !== null && item.full_day === null ? ' - ' + item.time_end : '' } ${item.hasOwnProperty('full_day') && item.full_day !== null ? ' Круглосуточно ' : '' }</div>
                      <a href="${item.link}" class="lombard-map__link">${item.details}</a>
                    `
                    });
                    infoWindows.push(infoWindow);

                    let hoverInfoWindow = new google.maps.InfoWindow({
                        content: `<div>№ ${item.number}</div>`
                    });
                    // End info Windows

                    // Start Event listeners
                    google.maps.event.addListener(marker, 'click', function () {
                        for (let i = 0; i < infoWindows.length; i++) {
                            infoWindows[i].close();
                        }
                        hoverInfoWindow.close();
                        infoWindow.open(this.map, marker);
                        // start style image if noload
                        let $lombardMapImage = $('.lombard-map__image');
                        if( $lombardMapImage.outerWidth() < 50) {
                          $lombardMapImage.hide();
                        }
                        // end style image if noload
                        currentMark = infoWindow;

                        // start show close btn
                        $('.lombard-map__image-wrapper').closest('.gm-style-iw').next().show();
                        // end show close btn
                    });

                    google.maps.event.addListener(marker, 'mouseover', function () {
                        if (currentMark) return;
                        hoverInfoWindow.open(this.map, marker);
                    });

                    google.maps.event.addListener(marker, 'mouseout', function () {
                        hoverInfoWindow.close();
                    });

                    google.maps.event.addListener(infoWindow, 'closeclick', function () {
                        currentMark = null;
                    });
                    // End Event listeners

                    return marker;
                });
                // End markers array

                let markerCluster = new MarkerClusterer(this.map, markers, {
                    // imagePath: 'img/cluster-image',
                    styles: [{
                        url: '/img/cluster-image.png',
                        width: 42,
                        height: 42,
                        textColor: '#fff',
                        textSize: 12
                    }],
                });


            }
        // end setCluster


    }

    function CreateMapDepartment(mapID, location) {
        CreateMap.apply(this, arguments);

        let lat = $('#departmentMap').data('lat');
        let lng = $('#departmentMap').data('lng');

        this.setMarker = function () {
            let marker = new google.maps.Marker({
                position: {lat: parseFloat(lat), lng: parseFloat(lng)},
                map: this.map,
                zoom: this.map.setZoom(14),
                icon: '/img/marker.png'
            });
        }
    }

    function initMap(locations) {
        // departments
        (function () {

            if (!$('#departmentsMap').length) return;
            departmentsMap = new CreateMapDepartments('departmentsMap', locations);
            departmentsMap.initMap();
            departmentsMap.setCluster();
        }());
        // department
        (function () {
            if (!$('#departmentMap').length) return;
            let departmentMap = new CreateMapDepartment('departmentMap');
            departmentMap.initMap();
            departmentMap.setMarker();
        }());
    };
});