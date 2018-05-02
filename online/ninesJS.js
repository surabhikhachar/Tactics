function addEvents() {
  let XO = document.getElementsByClassName("board"); // array of DOM tiles with indicies [0..80]
  let tables = document.getElementsByClassName("subtable");
  let box = document.getElementsByClassName("radio");

  let board = new ninerBoard();
  let page = new ninePageState(XO, tables, board);

  try { //Try block will only work if in continue game mode
    let daMoves = JSON.parse(document.getElementById("ignoreMe").value);
    console.log(daMoves);
    //Catch Game and Page objects up with current game
    daMoves.forEach(function(i) {
        board.move(i);
        page.updateBoard(false, i, board.selClass);
        page.grayOthers(i);
        if(board.checkBoardFull(i%9)){
          page.removeGrayedAll();
        }
        if(board.checkGameWin()) {
          page.updateBoard(true, i, board.selClass);
          page.finishGame(board.winner);
        }
    });
    //objects 'board' and 'page' are now up to date

    var nextMove = ((document.getElementById("ignoreMe").value)%2 == 0) ? "X" : "O";
  }
  catch(error) { //Catch block runs if game is being created
    var nextMove = "X";
  }

  let available = [];

  let add = []; //preallocate 'add[]' to be 81 indicies long
  for(let i = 0; i < 81; i++) {
    add[i] = 0;
  }

  //Update 'add[]' and 'available[]'
  //'add' assists JS with finding the correct radio button to check
  //'available' is a list of available tile positions
  for(let i = 0; i < 81; i++) {
    if(!XO[i].classList.contains("grayed") && !XO[i].classList.contains("selected")) //tile not taken
      available.push(i);
    else {
      for(let j = i; j < 81; j++) {
        add[j] += 1;
      }
    }
  }

  available.forEach(function(tile) {
    document.getElementsByTagName("body")[0].innerHTML += "<input type=\"radio\" name=\"move9\" value=\""+tile+"\" class=\"radio online\" required>";
  });

  //Add events for selecting a game move option
  for(let i = 0; i < 81; i++) {//81-segment loop - adds click event to each tile
    if(!XO[i].classList.contains("grayed") && !XO[i].classList.contains("selected")) {
      XO[i].addEventListener("click", function() {

        //remove current changes
        available.forEach(function(j) {
          if(XO[j].innerHTML != "") {
            XO[j].classList.remove("XSelect", "OSelect");
            XO[j].innerHTML = "";
            box[j-add[j]].checked = false;
          }
        });

        //add new potential changes
        XO[i].innerText = nextMove;
        XO[i].classList.add(nextMove+"Select");
        box[i - add[i]].checked = true;
      });
    }
  }

  // //Wait for user to attempt to submit move
  // try {
  //   document.getElementById("submit").addEventListener("click", function() {
  //     let myInputs = document.getElementsByClassName("online");
  //     let someChecked = false;
  //
  //     for (let i = 0; i < available.length; i++) {
  //       if(inputs[i].checked == true) {
  //         someChecked = true;
  //         break;
  //       }
  //     }
  //
  //     //Build 9-character game state string that that records if each sub-table is won
  //     if(someChecked) { //only runs if a move was made
  //       let DBGS = "";
  //       for(let i = 0; i < 9; i++)
  //       {
  //         if(page.tables[i].classList.contains("Awinner"))  DBGS = DBGS + 'A'; //Board is a catscratch
  //         else if (page.tables[i].classList.contains("Owinner"))  DBGS = DBGS + 'O'; //Board won by O
  //         else if (page.tables[i].classList.contains("Xwinner"))  DBGS = DBGS + 'X'; //Board won by X
  //         else DBGS = DBGS + 'N'; ////board not yet won
  //       }
  //
  //       document.getElementById("ignoreMe").value = DBGS; //send state all sneaky-like >:)
  //       document.getElementById("submit").value = board.winner;
  //     }
  //   });
  // } catch(e) {
  //   //nothing needs to happen, it's just a game create mode
  // }

  let myForm = document.getElementById("gameForm");
  if(myForm.addEventListener) {
    myForm.addEventListener("submit", checkState, false);  //Modern browsers
  }
  else if(myForm.attachEvent) {
    myForm.attachEvent('onsubmit', checkState);            //Old IE
  }
}



function checkState() {
  let tables = document.getElementsByClassName("subtable");
  let XO = document.getElementsByTagName("td");
  let radios = document.getElementsByClassName("radio");

  let moveVal = "";
  for(let i = 0; i < 81; i++) {
    if(radios[i].checked) {
      moveVal = radios[i].value;
      break;
    }
  }

  if(moveVal == "") return false;

  let board = new ninerBoard();
  let page = new ninePageState(XO, tables, board);

  try { //Try block will only work if in continue game mode
    let daMoves = JSON.parse(document.getElementById("ignoreMe").value);
    //Catch Game and Page objects up with current game
    daMoves.forEach(function(i) {
      // if(!page.XO[i].classList.contains("selected") && !page.XO[i].classList.contains("grayed")){
        board.move(i);
        // page.updateBoard(false, i, board.selClass);
        // page.grayOthers(i);
        if(board.checkBoardFull(i%9)){
          //page.removeGrayedAll();
        }
        if(board.checkGameWin()) {
          //page.updateBoard(true, i, board.selClass);
          //page.finishGame(board.winner);
        }
      // }
    });
    //objects 'board' and 'page' are now up to date

    var nextMove = ((document.getElementById("ignoreMe").value)%2 == 0) ? "X" : "O";
    bourd.move(moveVal);

    if(board.checkGameWin()) {
      //page.updateBoard(true, i, board.selClass);
      //page.finishGame(board.winner);
    }
  }
  catch(error) { //Catch block runs if game is being created
    var nextMove = "X";
  }
  document.getElementById("submit").value = available.length;

  board.move(moveVal);
  page.updateBoard(false, moveVal, board.selClass);

  if(board.checkGameWin()){
		page.updateBoard(true, moveVal, board.selClass);
		page.finishGame(board.winner);
  }

  let DBGS = "";
  for(let i = 0; i < 9; i++)
  {
    if(page.tables[i].classList.contains("Awinner"))
      DBGS = DBGS + 'A';
    else if (page.tables[i].classList.contains("Owinner"))
      DBGS = DBGS + 'O';
    else if (page.tables[i].classList.contains("Xwinner"))
      DBGS = DBGS + 'X';
    else  //board not yet won
      DBGS = DBGS + 'N';
  }

  document.getElementById("ignoreMe").value = DBGS; //send state all sneaky-like >:)
  if(board.winner != "") {
    document.getElementById("submit").value = board.winner;
  }

}
