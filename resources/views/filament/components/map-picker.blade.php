<div
    wire:ignore
    x-data="mapPicker($wire)"
    x-init="init()"
    style="width:100%;"
>

    <!-- Leaflet CSS -->
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div x-ref="map"
         style="height: 450px; width: 100%; border-radius: 12px;">
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        function mapPicker($wire) {
            return {
                map: null,
                marker: null,

                init() {
                    setTimeout(() => {
                        this.loadMap()
                    }, 300);
                },

                loadMap() {

                    // مركز مؤقت (رح يتغير حسب موقع المستخدم)
                    this.map = L.map(this.$refs.map).setView([33.5138, 36.2765], 6);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(this.map);

                    // 🔥 جلب موقع المستخدم كبداية
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                let lat = position.coords.latitude;
                                let lng = position.coords.longitude;

                                this.map.setView([lat, lng], 13);
                                this.setLocation(lat, lng);
                            },
                            () => {
                                console.log('Location permission denied');
                            }
                        );
                    }

                    // عند الضغط على الخريطة
                    this.map.on('click', (e) => {
                        this.setLocation(e.latlng.lat, e.latlng.lng);
                    });
                },

                async setLocation(lat, lng) {

                    // حذف الماركر القديم
                    if (this.marker) {
                        this.map.removeLayer(this.marker);
                    }

                    // إضافة ماركر جديد
                    this.marker = L.marker([lat, lng]).addTo(this.map);

                    // 🔥 تحديث Livewire مباشرة
                    $wire.set('data.latitude', lat);
                    $wire.set('data.longitude', lng);

                    try {
                        let response = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`
                        );

                        let data = await response.json();

                        let address = data.display_name ?? '';

                        let branchName =
                            data.address?.road ??
                            data.address?.city ??
                            data.address?.town ??
                            data.address?.village ??
                            'Branch';

                        $wire.set('data.address', address);
                        $wire.set('data.name', branchName);

                    } catch (error) {
                        console.error('Reverse geocoding error:', error);
                    }
                }
            }
        }
    </script>

</div>
