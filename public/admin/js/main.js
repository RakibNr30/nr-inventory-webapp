$(document).ready(function () {
    // init custom file input
    bsCustomFileInput.init();
});

function display(){
    const refresh = 1000;
    setTimeout('display_current_time()',refresh)
}
    function display_current_time() {
        let d = Date.now();
        d = new Date(d);
        d = '<i class="fa fa-calendar-alt"></i> ' + (d.getMonth()+1)+'/'+d.getDate()+'/'+d.getFullYear()+' &nbsp;&nbsp;&nbsp <i class="fa fa-clock"></i> '+(d.getHours() > 12 ? d.getHours() - 12 : d.getHours())+':'+d.getMinutes()+':'+d.getSeconds()+' '+(d.getHours() >= 12 ? "PM" : "AM");

    document.getElementById('currentTime').innerHTML = d;
    display();
}
