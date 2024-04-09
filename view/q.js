function resultados(){
    var res=document.createElement("tr");
    this.parentNode.insertBefore(res,this.nextSibling);
    var cel=document.createElement("td");
    cel.textContent="abc";
    res.appendChild(cel);
}