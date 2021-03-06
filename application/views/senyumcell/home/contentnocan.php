<div class="senyumcell-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <p href="#" class="list-group-item active">
                        <span class="glyphicon glyphicon-menu-hamburger"></span> Menu Kategori
                    </p>
                    <a href="#" class="list-group-item">- Nomor Cantik</a>
                    <a href="#" class="list-group-item">- Nomor Pasangan</a>
                    <a href="#" class="list-group-item">- Nomor Tahun</a>
                    <a href="#" class="list-group-item">- CDMA</a>
                    <a href="#" class="list-group-item">- GSM</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="turun20">
                    <h4 class="title-garis text-center">
                        <span>&nbsp;&nbsp;&nbsp;Nomor<span style="color: #3498db;">Cantik</span></span>
                    </h4>	
                </div>
                <div id="postList">
                    <div class="row">
                        <?php
                        foreach ($nocan->result() as $n) {
                            echo "<div class = 'col-sm-6 col-md-4'>
                            <div class = 'panel panel-default'>
                                <div class = 'panel-body'>
                                    <div class = 'media'>
                                        <div class = 'media-left'>
                                            <a>
                                                <img width='50px' height='40px' class = 'media-object' src = " . base_url() . "pictures/" . $n->logoprovider . " alt = 'logo operator'>
                                            </a>
                                        </div>
                                        <div class = 'media-body'>
                                            <h4 class = 'media-heading'>" . $n->nomorproduct . "</h4>
                                            Rp " . $n->hargaproduct . "
                                        </div>
                                        <div class = 'media-right'>
                                            <p></p>
                                            <button type = 'button' class = 'btn btn-primary btn-sm'>Beli</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                        ?>
                    </div>


                    <!--start pagination-->

                    <div class = "row">
                        <div class = "col-md-12">
                            <?php
                            if ($nocanall->num_rows() <= $perpage) {
                                echo "<div class='panel panel-default'>
                                    <div class='panel-heading text-right'>Showing : " . $nocanall->num_rows() . " Product</div>
                                </div>";
                            } else {
                                echo "<div class='text-center'>" . $this->ajax_pagination->create_links() . "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <!--end pagination-->

                </div>


                <!-------->
                <div class = "turun20">

