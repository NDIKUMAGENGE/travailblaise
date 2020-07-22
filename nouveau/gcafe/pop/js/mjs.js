$(document).ready(function(){
    $("#btn").click(function(){
        var date=$("#date").val();
        var annee=$("#annee").val();
        var montant=$("#montant").val();
/*$.post("savebudget.php",{date:date,annee:annee,montant:montant},function(data){
   alert(data);
   $("#msg").html(data);
})*/

$.ajax({
    type:"POST",
    url:"savebudget.php",
    data:{date:date,annee:annee,montant:montant},
    success:function(data){
        $("#msg").html(data);  
    }

})
})
})

document.getElementById('bdget').addEventListener('click',myFun);
 function myFun(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","budget.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );
}
   }
   xhr.send();
 }

document.getElementById('univ').addEventListener('click',myFun2);
 function myFun2(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","universites.php",true);
   
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }

 document.getElementById('camp').addEventListener('click',myFun3);
 function myFun3(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","campus.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }
 document.getElementById('dep').addEventListener('click',myFun4);
 function myFun4(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","facultes.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }
 document.getElementById('fil').addEventListener('click',myFun5);
 function myFun5(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","filieres.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }

 document.getElementById('fich').addEventListener('click',myFunfic);
 function myFunfic(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","ficheDemande.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }
  document.getElementById('fich2').addEventListener('click',myFunfic2);
 function myFunfic2(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","listeDemandeurs.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }
 
 document.getElementById('fich3').addEventListener('click',myFunfic3);
 function myFunfic3(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","listeDemandeAccepte.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }
  
 document.getElementById('nouvelUni').addEventListener('click',addUni);
 function addUni(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","nouvelleUniversite.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('add').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }
 
document.getElementById('fac').addEventListener('click',myFunfac);
 function myFunfac(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","departement.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée' );

     }
   }
   xhr.send();
 }


 

 
 document.getElementsByClassName('fich4').addEventListener('click',myFunbours);
 function myFunbours(){
   var xhr=new XMLHttpRequest();
   xhr.open("GET","donnerBourse.php",true);
   xhr.onload=function(){
     if(xhr.status==200){
       //document.write(this.responseText);
 document.getElementById('show').innerHTML=xhr.responseText;
     }
     else{
      document.write('Page non trouvée');
}
   }
   xhr.send();
 }
 function plusme(el){
	var elp=el.parentNode;
	var elfi=el.parentNode.childNodes;

	if(el.innerHTML=="Show Profile")
	{
		el.innerHTML="Hide Profile";
		elfi[2].style.display="block";
	}else{
		el.innerHTML="Show Profile";
		elfi[2].style.display="none";
	}
}
                
$(document).ready(function(){
  $(".flip").click(function(){
    $(".pop").slideToggle("slow");
  });
});  