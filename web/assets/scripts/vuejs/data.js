Vue.filter('moment', function (value) {
    return moment(value).format('DD-MM-YYYY');
});
let data = new Vue({
    el: '#app',
    delimiters: ['${', '}'],
    data: {
        users: [],
        vehicules: [],
        constat: {},
        permis:[],
        all: [],
        empty:true
    },
    methods: {
        getUsers(accident){
            this.$http.get('/app_dev.php/api/accident/' + accident).then((response) => {
                this.all = response.body;
                setTimeout(function () {
                    $(document).ready(function () {
                        $('.owl-carousel').owlCarousel({
                            margin: 20
                        })
                    })
                }, 2000)
            }).catch((err) => {
                console.error(err);
            })
        },
        getUserObjects(user_id){
            this.$http.get('/app_dev.php/api/profile/get/' + user_id).then((response) => {
                this.vehicules = response.body.vehicules;
                this.permis = response.body.permis;
                this.empty = false;
            }).catch((error) => {
                console.error(error);
            })
        },
        getDossierObjects(dossier_id){
            this.$http.get('/app_dev.php/api/dossier/get/' + dossier_id).then((response) => {
                this.all = response.body;
                console.log(this.all);
            }).catch((error) => {
                console.error(error);
            })
        },
        getVehiculeTypeById(typeId){
            categorieVehicule = ['B','A','C'];
            return categorieVehicule[typeId];

        }
    }

})