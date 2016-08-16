<h4 class="title-garis text-center">
    <span>
        &nbsp;&nbsp;&nbsp;Nomor<span style="color: #3498db;">Berpasangan</span> 
    </span>
</h4>	
</div>

<div class="nomorberpasangan">			
    <div class="row">
        <?php
        foreach ($statusnopas->result() as $s) {
            echo "<div class='col-sm-4 col-md-3'>
            <div class='panel panel-primary text-center'>";
            $nopas = $this->ProductModel->getNoPasByStatus($s->statuspasangan)->result();
            $harganopas = $this->ProductModel->getHargaTotalByStatus($s->statuspasangan)->result();
            echo"<div class='panel-heading'`>
                    <h3 class='panel-title'>Rp ";
            foreach ($harganopas as $h) {
                echo $h->hargatotal;
            }
            echo "</h3>
     </div>
    <div class='panel-body'>";
            foreach ($nopas as $np) {
                echo "<p>
                    <h8><strong>" . $np->nomorproduct . " -- " . $np->namaprovider . "</strong></h8>
              </p>";
            }
            echo "<p><a href='#' class='btn btn-primary'>Beli</a> <a href='#' class='btn btn-success'>Lihat</a> </p>
                </div>
            </div>
        </div>";
        }
        ?>
    </div>

    <div class="row panel-link">
        <div class="col-md-12">	
            <div class="panel panel-default">
                <div class="panel-heading text-right"><a href="#">Lihat Semua Nomor Berpasangan >></a></div>
            </div>
        </div>
    </div>




</div>
</div>
</div>
</div>
