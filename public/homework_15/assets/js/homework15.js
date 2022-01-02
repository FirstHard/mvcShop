    function addLog(message) {
      let results = document.getElementById('results');
      results.innerHTML += message + '<br>';
      results.scrollTop = results.scrollHeight;
    }

    document.addEventListener("DOMContentLoaded", () => {
      addLog('<h5 class="text-light">Welcome to my Console!</h5>');
      addLog('<span class="text-info">The buttons at the top manipulate the contents of LocalStorage: fill it with data from a file or clear it. Try pushing them.</span>');
      document.querySelectorAll('code').forEach((block) => {
        block.addEventListener("click", function(item) {
          let command_text = item.src.innerText.trim();
          let tmp = document.createElement("textarea");
          document.querySelector("body").append(tmp);
          tmp.append(command_text);
          tmp.select();
          document.exec("copy");
          tmp.remove();
        });
      });

      var console_line = document.getElementById('console_line');

      let startButtons = document.querySelectorAll('.links a.storage');
      startButtons.forEach((button) => {
        button.addEventListener("click", function(item) {
          item.preventDefault();
          let url = button.getAttribute('href');
          if (url == '#import_json') {
            playSound('storage/files/mp3/click.mp3');
            addLog('<span class="text-success">Start to filling LocalStorage...</span>');
            var sourseJsonFilePath = 'storage/json/students_data.json';
            var jsonObj;
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    jsonObj = JSON.parse(this.responseText);
                    jsonObj.forEach((row, index) => {
                      localStorage[index] = JSON.stringify(row);
                      addLog('<span class="text-info">' + JSON.stringify(row) + '</span>');
                    });
                    addLog('<span class="text-success">LocalStorage is full!</span>');
                  }
                };
            xmlhttp.open("GET", sourseJsonFilePath, true);
            xmlhttp.send();
          }
          if (url == '#clear_ls') {
            playSound('storage/files/mp3/error.mp3');
            localStorage.clear();
            addLog('<span class="text-danger">LocalStorage cleared!</span>');
          }
          return false;
        });
      });
    });

    function playSound(url) {
      const audio = new Audio(url);
      audio.play();
    }