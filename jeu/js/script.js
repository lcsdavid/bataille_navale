function changeClass(old_class, new_class)
{
    document.getElementsByClassName(old_class).className = new_class;
}

window.onload = function()
{
    document.getElementById("MyElement").addEventListener( 'click', changeClass);
}

$this.on