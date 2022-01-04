let command = null;
let option = null;

const addLog = (message, level = 'info', sound = false) =>
{
  let results = document.getElementById('results');
  results.innerHTML += '<span class="text-' + level + '">' + message + '</span><br>';
  results.scrollTop = results.scrollHeight;
  if (sound) playSound(sound);
}

const averageValue = (array, key) =>
{
  var total = 0;
  array.forEach((item) => {
    total += item[key];
  });
  return Math.round(total / array.length);
}

const maxNumber = (array, key) =>
{
  var values = [];
  array.forEach((item) => {
    values.push(item[key]);
  });
  return Math.max.apply(null, values);
}

const countValues = (array, key, param) =>
{
  var total = 0;
  array.forEach((item) => {
    if (item[key] === param) total++;
  });
  return total;
}

const getDataByCommand = (command, option) =>
{
  if (command == '/show') {
    addLog('> ' + command + ' ' + option, 'light');
    if (localStorage.length > 0) {
      let students = JSON.parse(localStorage.getItem("students"));
      let param;
      let key;
      switch (option) {
        case '--average-age':
          param = 'age';
          addLog('# Average age of students: ' + averageValue(students, param) + ' years');
          break;
        case '--max-lang-count':
          param = 'langCount';
          addLog('# Maximum number of languages: ' + maxNumber(students, param));
          break;
        case '--count-female':
          key = 'sex';
          param = 'Female';
          addLog('# Number of girls among students: ' + countValues(students, key, param));
          break;
        case '--count-male':
          key = 'sex';
          param = 'Male';
          addLog('# Number of guys among students: ' + countValues(students, key, param));
          break;
        default:
          break;
      }
    } else {
      addLog('First click the button at the top: Import data to LocalStorage', 'danger', 'error');
    }
    return false;
  }
}

const countryValidate = (country) => {
  if (country) {
    if (country[0] == country[0].toUpperCase()) {
      if (country.length >= 4) {
        return true;
      } else {
        addLog('Country name must be 4 or more characters!', 'warning', 'error');
      }
    } else {
      addLog('Country name must start with a capital letter!', 'warning', 'error');
    }
  } else {
    addLog('Country name is EMPTY, NULL or UNDEFINED!', 'warning', 'error');
  }
  return false;
}

const parseCommand = (command_text) => 
{
  let command_arr = command_text.split(' ');
  let command;
  let option;
  if (command_arr[0].substr(0, 1) == '/') {
    command = command_arr[0];
    if (command_arr[1].substr(0, 2) == '--') {
      option = command_arr[1];
      getDataByCommand(command, option);
    } else {
      addLog('It`s a command without option! Please input command with option!', 'warning', 'error');
    }
  } else {
    let countriesJsonFilePath = 'storage/json/es_countries.json';
    var jsonCountriesObj;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      jsonCountriesObj = JSON.parse(this.responseText);
        //let countries = localStorage.getItem("es_countries", JSON.stringify(jsonCountriesObj));
        let countries = JSON.stringify(jsonCountriesObj.es_countries);
        if (countryValidate(command_text)) {
          console.log('true');
          if (result = countries.includes(command_text)) {
            addLog('Correct, the country you entered is a member of the EU!', 'success', 'success');
          } else {
            addLog('Incorrect, the country you entered is not a member of the EU! Please try again.', 'warning', 'error');
          }
        }
      }
    };
    xmlhttp.open("GET", countriesJsonFilePath, true);
    xmlhttp.send();
  }
}

document.addEventListener("DOMContentLoaded", () =>
{
  addLog('Welcome to my Console!', 'light');
  addLog('The buttons at the top manipulate the contents of LocalStorage: fill it with data from a file or clear it. Try pushing them.');
  var command_line = document.getElementById('command_line');
  command_line.addEventListener("submit", function(command) {
    command.preventDefault();
    var command_text = document.getElementById('console_line').value;
    parseCommand(command_text);
    document.getElementById('console_line').value = "";
  });

  let startButtons = document.querySelectorAll('.links a.storage');
  startButtons.forEach((button) => {
    button.addEventListener("click", function(item) {
      item.preventDefault();
      let url = button.getAttribute('href');
      if (url == '#import_json') {
        addLog('Start to filling LocalStorage...', 'click');
        var studentsJsonFilePath = 'storage/json/students_data.json';
        var jsonObj;
        var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                jsonObj = JSON.parse(this.responseText);
                localStorage.setItem("students", JSON.stringify(jsonObj));
                addLog('LocalStorage is full!', 'success', 'click');
              }
            };
        xmlhttp.open("GET", studentsJsonFilePath, true);
        xmlhttp.send();
      }
      if (url == '#clear_ls') {
        localStorage.clear();
        addLog('LocalStorage cleared!', 'danger', 'error');
      }
      return false;
    });
  });
});

const playSound = (sound) =>
{
  let soundUrl = 'storage/files/mp3/' + sound + '.mp3';
  const audio = new Audio(soundUrl);
  audio.play();
}