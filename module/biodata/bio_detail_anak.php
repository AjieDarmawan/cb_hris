<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title;?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="?p=biodata"> Biodata</a></li>
        <li><a href="?p=anak"> Anak</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        
        <!-- Your Page Content Here -->
        <div class="row">
            
            <!-- PENDIDIKAN--> 
            <div class="col-md-3">
              <!-- Info Boxes -->   
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-graduation-cap"></i></span>
                <div class="info-box-content">
                  <span class="info-box-number">Pendidikan Formal Anak</span>
                  <span class="progress-description">
                    70% Kelengkapan Data
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="info-box-text"><a href="?p=pendidikan_formal" style="color: inherit">Perbaharui <i class="fa fa-chevron-right"></i></a></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box --> 
            </div>
            <!-- /.col -->
            
            <!-- PENYAKIT--> 
            <div class="col-md-3">
              <!-- Info Boxes -->   
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-heartbeat"></i></span>
                <div class="info-box-content">
                  <span class="info-box-number">Riwayat Penyakit Anak</span>
                  <span class="progress-description">
                    70% Kelengkapan Data
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="info-box-text"><a href="?p=riwayat_penyakit" style="color: inherit">Perbaharui <i class="fa fa-chevron-right"></i></a></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box --> 
            </div>
            <!-- /.col -->
            
        </div>
        <!-- /.row --> 
      
    </section>
    <!-- /.content --> 