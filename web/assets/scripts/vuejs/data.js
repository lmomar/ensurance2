Vue.filter('moment', function (value) {
    return moment(value).format('DD-MM-YYYY');
});
var api_url = "http://api.ensurance.dev/app_dev.php";
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
            this.$http.get(api_url + '/accident/' + accident).then((response) => {
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
            this.$http.get(api_url + '/profile/get/' + user_id).then((response) => {
                this.vehicules = response.body.vehicules;
                this.permis = response.body.permis;
                this.empty = false;
            }).catch((error) => {
                console.error(error);
            })
        },
        getDossierObjects(dossier_id){
            this.$http.get(api_url + '/dossier/get/' + dossier_id).then((response) => {
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