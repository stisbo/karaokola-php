        <?php
        include('../conexion.php');
        $sql = "SELECT DISTINCT interprete FROM tblcanciones WHERE tipo LIKE 'KARAOKE'";
        $conn = db();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="content-header manage-movile">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-12">
                <h1 class="m-0" style="display:inline-block">Karaokes</h1>
              </div>
            </div>
          </div>
        </div>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

            </div>
            <div class="row">

              <section class="col-lg-12 connectedSortable">
                <div class="card direct-chat direct-chat-primary">
                  <div class="card-header" id="buscador-general">

                    <div class="form-inline" style="float:left">
                      <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control" id="busqueda_karaokes" onkeyup="listar_karaokes(1)" type="search" placeholder="Buscar" aria-label="Search">
                        <div class="input-group-append">
                          <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="float-left mt-2">
                      <label for="select_artistas">Artistas</label>
                      <select id="select_artistas" class="form-control select_artistas">
                        <option value=""> TODOS </option>
                        <?php
                        foreach($result as $row):
                        ?>
                        <option value="<?=$row['interprete']?>"><?=$row['interprete']?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="for-pagination1"></div>
                    <div id="karaokes-result"></div>
                    <div id="for-pagination2"></div>
                  </div>
                  <div class="card-footer">
                  </div>
                </div>

              </section>

            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>