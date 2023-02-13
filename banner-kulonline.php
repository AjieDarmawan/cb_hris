<style>
.card-holder {
  margin: 2em 0;
}

.card {
  font-family: -apple-system, BlinkMacSystemFont, 'Open Sans', sans-serif;
  font-size: 3em;
  font-weight: 800;
  height: 4em;
  width: 64em;
  padding: 0.5em 1em;
  border-radius: 0.25em;
  display: table-cell;
  vertical-align: middle;
  letter-spacing: -2px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.card em {
  font-size: 1.5em;
}

.card small {
  font-size: 0.4em;
  letter-spacing: -1px;
}

.card-button {
  font-family: -apple-system, BlinkMacSystemFont, 'Open Sans', sans-serif;
  font-size: 0.5em;
  font-weight: 800;
  height: auto;
  width: auto;
  padding: 0.5em 1em;
  border-radius: 0.25em;
  display: table-cell;
  vertical-align: middle;
  letter-spacing: -1px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.card-button small {
    font-size: 0.7em;
}

.text-white {
    color: #fff;
}

.text-dark {
    color: #000;
}

.text-primary {
    color: #01588e;
}

.text-warning {
    color: #ffc608;
}

.text-center {
    text-align: center;
}

.bg-gold {
  background: -webkit-linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);
  background: -o-linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);
  background: -moz-linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);
  background: linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);
}

.bg-kulonline-1 {
    background: -webkit-linear-gradient(70deg, #fff810  30%, rgba(0,0,0,0) 30%), -webkit-linear-gradient(30deg, #63e89e 60%, #ff7ee3 60%);
    background: -o-linear-gradient(70deg, #fff810  30%, rgba(0,0,0,0) 30%), -o-linear-gradient(30deg, #63e89e 60%, #ff7ee3 60%);
    background: -moz-linear-gradient(70deg, #fff810  30%, rgba(0,0,0,0) 30%), -moz-linear-gradient(30deg, #63e89e 60%, #ff7ee3 60%);
    background: linear-gradient(70deg, #fff810  30%, rgba(0,0,0,0) 30%), linear-gradient(30deg, #63e89e 60%, #ff7ee3 60%);
}

.bg-kulonline-2 {
    background: -webkit-linear-gradient(70deg, #4bc6ff  30%, rgba(0,0,0,0) 30%), -webkit-linear-gradient(30deg, #63e89e 60%, #fff10f 60%);
    background: -o-linear-gradient(70deg, #4bc6ff  30%, rgba(0,0,0,0) 30%), -o-linear-gradient(30deg, #63e89e 60%, #fff10f 60%);
    background: -moz-linear-gradient(70deg, #4bc6ff  30%, rgba(0,0,0,0) 30%), -moz-linear-gradient(30deg, #63e89e 60%, #fff10f 60%);
    background: linear-gradient(70deg, #4bc6ff  30%, rgba(0,0,0,0) 30%), linear-gradient(30deg, #63e89e 60%, #fff10f 60%);
}

.bg-kulonline-3 {
    background: -webkit-linear-gradient(70deg, #ff9239  30%, rgba(0,0,0,0) 30%), -webkit-linear-gradient(30deg, #a98eff 60%, #ff8989 60%);
    background: -o-linear-gradient(70deg, #ff9239  30%, rgba(0,0,0,0) 30%), -o-linear-gradient(30deg, #a98eff 60%, #ff8989 60%);
    background: -moz-linear-gradient(70deg, #ff9239  30%, rgba(0,0,0,0) 30%), -moz-linear-gradient(30deg, #a98eff 60%, #ff8989 60%);
    background: linear-gradient(70deg, #ff9239  30%, rgba(0,0,0,0) 30%), linear-gradient(30deg, #a98eff 60%, #ff8989 60%);
}
</style>


<div class="card-holder">
  <div id="card" class="card bg-kulonline-1">
   Kuliah Online<br>
   <small><em>di 57 PTS Terbaik</em></small><br>
   <div class="card-button bg-gold text-center">Silahkan Klik Daftar</div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        var randomClass = "bg-kulonline-"+Math.floor((Math.random() * 3) + 1);
        console.log('color',randomClass);
        $('#card').addClass(randomClass);
    });
</script>