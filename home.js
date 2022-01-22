const change = document.getElementById('button');

    change.addEventListener('click', () => {
     document.getElementById('text').classList.toggle('font-color');
    });

    document.getElementById("text-button").onclick = function() {
      var register = document.getElementById("tex");
      if(register.innerHTML == "解除"){
        register.innerHTML = "登録";//登頂
        
       } else if(register.innerHTML == "登録") {
        register.innerHTML = "解除";//未踏
       } 
       window.location.href = 'next.php?summit_id=9';
       };

  
    
    