document.addEventListener("DOMContentLoaded", () => {
  addLog('Welcome to my Console!', 'light');
  addLog('The buttons at the top manipulate the contents of LocalStorage: fill it with data from a file or clear it. Try pushing them.');

  const command_line = document.getElementById('command_line');

  command_line.addEventListener("submit", (command) => {
    command.preventDefault();
    const command_text = document.getElementById('console_line').value;
    parseCommand(command_text);
    document.getElementById('console_line').value = "";
  });

  const startButtons = document.querySelectorAll('.links a.storage');

  startButtons.forEach((button) => {

    button.addEventListener("click", (item) => {
      item.preventDefault();
      const url = button.getAttribute('href');

      if (url === '#import_json') {
        addLog('Start to filling LocalStorage...', 'click');
        fetch('storage/json/students_data.json')
        .then((response) => 
          response.json()
        )
        .then((json) => {
          localStorage.setItem("students", JSON.stringify(json));
          addLog('LocalStorage is full!', 'success', 'click');
        });      
      }

      if (url === '#clear_ls') {
        localStorage.clear();
        addLog('LocalStorage cleared!', 'danger', 'error');
      }

      return false;
    });
  });
});

const addLog = (message, level = 'info', sound = false) => {
  const results = document.getElementById('results');
  results.innerHTML += `<span class="text-${level}">${message}</span><br>`;
  results.scrollTop = results.scrollHeight;

  if (sound) {
    playSound(sound);
  }
};

const averageValue = (array, key) => {
  let total = array.reduce((sum, item) => {
    return sum + item[key];
  }, 0);

  return Math.round(total / array.length);
};

const maxNumber = (array, key) => {
  let total = array.reduce((values, item) => {
    values.push(item[key]);
    return values;
  }, []);

  return Math.max.apply(null, total);
};

const countValues = (array, key, param) => {
  let total = array.reduce((sum, item) => {
    if (item[key] === param) {
      sum++;
    }

    return sum;
  }, 0);

  return total;
};

const getDataByCommand = (command, option) => {
  if (command === '/show') {
    addLog(`> ${command} ${option}`, 'light');
    if (localStorage.length > 0) {
      const students = JSON.parse(localStorage.getItem("students"));
      let param;
      let key;
      switch (option) {

        case '--average-age':
          param = 'age';
          addLog(`# Average age of students: ${averageValue(students, param)} years`);
          break;

        case '--max-lang-count':
          param = 'langCount';
          addLog(`# Maximum number of languages: ${maxNumber(students, param)}`);
          break;

        case '--count-female':
          key = 'sex';
          param = 'Female';
          addLog(`# Number of girls among students: ${countValues(students, key, param)}`);
          break;

        case '--count-male':
          key = 'sex';
          param = 'Male';
          addLog(`# Number of guys among students: ${countValues(students, key, param)}`);
          break;

        default:
          addLog('Wrong command!', 'danger', 'error');
          break;
      }
    } else {
      addLog('First click the button at the top: Import data to LocalStorage', 'danger', 'error');
    }

    return false;
  }
};

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
};

const parseCommand = (command_text) => {
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
    fetch('storage/json/es_countries.json')
    .then((response) => 
      response.json()
    )
    .then((json) => {
      let countries = JSON.stringify(json);

      if (countryValidate(command_text)) {
        if (countries.includes(command_text)) {
          addLog('Correct, the country you entered is a member of the EU!', 'success', 'success');
        } else {
          addLog('Incorrect, the country you entered is not a member of the EU! Please try again.', 'warning', 'error');
        }
      }
    });
  }
};

const playSound = (sound) => {
  let soundUrl = `storage/files/mp3/${sound}.mp3`;
  const audio = new Audio(soundUrl);
  audio.play();
};