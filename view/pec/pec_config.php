<div class="row">
    <div class="col-12 col-lg-6 ">
        <form id="pecData" action="controller/updatePec.php" method="post">     
            <input type="hidden" id="action"name="action" value ="updateDataPec">
            <input type="hidden" id="id" name="id" value="<?=$pec['id']?>">
                <div class="form-group">
                    <input type="text" class="form-control" id="host" name="host" value="<?=$pec['host']?>">
                    <label for="host">Host</label>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="user" name="user" value="<?=$pec['user']?>">
                    <label for="user">User</label>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="pass" name="pass" value="<?=$pec['pass']?>">
                    <label for="pass">Password</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="port" name="port" value="<?=$pec['port']?>">
                    <label for="port">Port</label>
                </div>
                <button class="btn btn-primary btn-sm"  type="submit" >Aggiorna Dati Pec </button>

        </form>
    </div>
</div>