<div class="row" id="app">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="above">
                            <p class="text-center">
                                <img src="<?php echo base_url() ?>assets/img/mappi_100.png" alt="" class="img-responsive">
                            </p>
                            <h1 class="text-center">Aplikasi SPK Seleksi Penerimaan Beasiswa</h1>
                            <h3 class="text-center text-black-50">Dinas Pendidikan dan Pengajaran</h3>
                            <h3 class="text-center text-black-50">Kabupaten Mappi</h3>
                        </div>
                    </div>
                </div>
                <div class="row" v-show="isAdmin">
                    <div class="col-md-6">
                        <div class="card text-white bg-primary">
                            <div class="card-body pb-0" style="z-index: 1">
                                <div class="btn-group float-right">
                                    <a href="<?php echo site_url() ?>/mahasiswa" class="btn btn-transparent">
                                        <i class="icon-pencil"></i>
                                    </a>
                                </div>
                                <div class="text-value">{{ count_mhs }}</div>
                                <div>Mahasiswa Terdata</div>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                                <i class="fa fa-graduation-cap ikon-dash"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-warning">
                            <div class="card-body pb-0" style="z-index: 1">
                                <div class="btn-group float-right">
                                    <a href="<?php echo site_url() ?>/kriteria" class="btn btn-transparent">
                                        <i class="icon-pencil"></i>
                                    </a>
                                </div>
                                <div class="text-value">{{ count_kriteria }}</div>
                                <div>Kriteria Terdata</div>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                                <i class="fa fa-tasks ikon-dash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var app = new Vue({
  el: '#app',
  created(){
    this.GetData();
  },
  data: {
  	count_mhs: 0,
    count_kriteria: 0,
    isAdmin:false,
  },
  methods: {
    GetData()
    {
        axios
            .post(locationServer+'/api/mahasiswa/mahasiswas', {body: {}})
            .then(response => {
                this.count_mhs = response.data.length
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false )
        axios
            .post(locationServer+'/api/kriteria/kriterias', {body: {}})
            .then(response => {
                this.count_kriteria = response.data.length
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false )

            if(this.$cookies.get("tokenUserApp") !== "" && this.$cookies.get("tokenUserApp") !== null && this.$cookies.get("tokenUserApp") !== "undefined"){
               this.isAdmin = this.$cookies.get("tokenUserApp") == '1'? true:false;
            }
    },
  }
})

loaderStop()      
</script>