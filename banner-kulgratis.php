<style>
.card-holder {
  margin: 2em 0;
}

.card {
  font-family: -apple-system, BlinkMacSystemFont, 'Open Sans', sans-serif;
  font-size: 1.4em;
  font-weight: 800;
  height: 4em;
  width: 64em;
  padding: 0.5em 1em;
  border-radius: 0.25em;
  display: table-cell;
  vertical-align: middle;
  letter-spacing: 0px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.card em {
  font-size: 1.5em;
}

.card small {
  font-size: 0.5em;
  letter-spacing: 0px;
}

.card-button {
  font-family: -apple-system, BlinkMacSystemFont, 'Open Sans', sans-serif;
  font-size: 0.7em;
  font-weight: 700;
  height: auto;
  width: auto;
  padding: 0.5em 1em;
  border-radius: 0.25em;
  display: table-cell;
  vertical-align: middle;
  letter-spacing: 0px;
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

.bg-purple {
    background: -webkit-linear-gradient(110deg, #a60af3 40%, rgba(0, 0, 0, 0) 30%), -webkit-radial-gradient(farthest-corner at 0% 0%, #7a00cc 70%, #c03fff 70%);
    background: -o-linear-gradient(110deg, #a60af3 40%, rgba(0, 0, 0, 0) 30%), -o-radial-gradient(farthest-corner at 0% 0%, #7a00cc 70%, #c03fff 70%);
    background: -moz-linear-gradient(110deg, #a60af3 40%, rgba(0, 0, 0, 0) 30%), -moz-radial-gradient(farthest-corner at 0% 0%, #7a00cc 70%, #c03fff 70%);
    background: linear-gradient(110deg, #a60af3 40%, rgba(0, 0, 0, 0) 30%), radial-gradient(farthest-corner at 0% 0%, #7a00cc 70%, #c03fff 70%);
}

.bg-beasiswa-1 {
    background: -webkit-linear-gradient(110deg, #000 33%, rgba(0, 0, 0, 0) 33%), -webkit-linear-gradient(110deg, #dd0000 66%, #ffc608 66%);
    background: -o-linear-gradient(110deg, #000 33%, rgba(0, 0, 0, 0) 33%), -o-linear-gradient(110deg, #dd0000 66%, #ffc608 66%);
    background: -moz-linear-gradient(110deg, #000 33%, rgba(0, 0, 0, 0) 33%), -moz-linear-gradient(110deg, #dd0000 66%, #ffc608 66%);
    background: linear-gradient(110deg, #000 33%, rgba(0, 0, 0, 0) 33%), linear-gradient(110deg, #dd0000 66%, #ffc608 66%);
}

.bg-beasiswa-2 {
    background: -webkit-linear-gradient(110deg, #6c00ff 33%, rgba(0, 0, 0, 0) 33%), -webkit-linear-gradient(110deg, #dd0000 66%, #3ab873 66%);
    background: -o-linear-gradient(110deg, #6c00ff 33%, rgba(0, 0, 0, 0) 33%), -o-linear-gradient(110deg, #dd0000 66%, #3ab873 66%);
    background: -moz-linear-gradient(110deg, #6c00ff 33%, rgba(0, 0, 0, 0) 33%), -moz-linear-gradient(110deg, #dd0000 66%, #3ab873 66%);
    background: linear-gradient(110deg, #6c00ff 33%, rgba(0, 0, 0, 0) 33%), linear-gradient(110deg, #dd0000 66%, #3ab873 66%);
}

.bg-beasiswa-3 {
    background: -webkit-linear-gradient(110deg, #3ab873 33%, rgba(0, 0, 0, 0) 33%), -webkit-linear-gradient(110deg, #000 66%, #6c00ff 66%);
    background: -o-linear-gradient(110deg, #3ab873 33%, rgba(0, 0, 0, 0) 33%), -o-linear-gradient(110deg, #000 66%, #6c00ff 66%);
    background: -moz-linear-gradient(110deg, #3ab873 33%, rgba(0, 0, 0, 0) 33%), -moz-linear-gradient(110deg, #000 66%, #6c00ff 66%);
    background: linear-gradient(110deg, #3ab873 33%, rgba(0, 0, 0, 0) 33%), linear-gradient(110deg, #000 66%, #6c00ff 66%);
}
</style>



<div class="card-holder">
  <div id="card" class="card bg-beasiswa-1 text-white">
     Kuliah Gratis<br>(Beasiswa)<br>
     <div class="card-button bg-purple text-center"><small>Hanya dengan merekomendasikan</small><br>
     0 s/d 4 Orang<br>
     <small>Anda bisa kuliah gratis (Beasiswa)</small></div>
     <small>*Kuota Terbatas</small>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        var randomClass = "bg-beasiswa-"+Math.floor((Math.random() * 3) + 1);
        console.log('color',randomClass);
        $('#card').addClass(randomClass);
    });
</script>