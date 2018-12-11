const $table = $('#table');
const $remove = $('#remove');
let selections = [];


function initTable() {
    $table.bootstrapTable({
    pagination: true,
    height: getHeight(),

    contentType: "application/x-www-form-urlencoded",
    columns: [
      [
        {
          field: 'state',
          checkbox: true,
          rowspan: 2,
          align: 'center',
          valign: 'middle'
        }, {
          title: 'Question ID',
          field: 'id',
          rowspan: 2,
          colspan: 1,
          align: 'center',
          valign: 'middle',
          sortable: true
        }, {
          title: 'Question Detail',
          colspan: 10,
          align: 'center'
        }
      ],
      [
        {
          field: 'title',
          title: 'Title',
          align: 'center'
        }, {
          field: 'isFrequency',
          title: 'Is Frequent',
          sortable: true,
          align: 'center',
        }, {
          field: 'isNew',
          title: 'Is New',
          sortable: true,
          align: 'center',
        }, {
          field: 'isJJ',
          title: 'Is Jijing',
          sortable: true,
          align: 'center',
        }, {
          field: 'isDifficult',
          title: 'Difficulty',
          sortable: true,
          align: 'center',
        }, {
          field: 'createDate',
          title: 'Creation Date',
          sortable: true,
          align: 'center',
        }, {
            field: 'updateDate',
            title: 'Update Date',
            sortable: true,
            align: 'center',
          }, {
            field: 'inputUser',
            title: 'Input User',
            sortable: true,
            align: 'center',
         },{
          field: 'operate',
          title: 'Operations',
          align: 'center',
          events: operateEvents,
          formatter: operateFormatter
        }
      ]
    ]
  });
  // sometimes footer render error.
  setTimeout(() => {
    $table.bootstrapTable('resetView');
  }, 200);

  $table.on('check.bs.table uncheck.bs.table ' +
            'check-all.bs.table uncheck-all.bs.table', () => {
    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);

    // save your data, here just save the current page
    selections = getIdSelections();
    // push or splice the selections if you want to save all data selections
  });

  $table.on('expand-row.bs.table', (e, index, row, $detail) => {
    if (index % 2 == 1) {
      $detail.html('Loading from ajax request...');
      $.get('LICENSE', res => {
        $detail.html(res.replace(/\n/g, '<br>'));
      });
    }
  });

  $table.on('all.bs.table', (e, name, args) => {
    console.log(name, args);
  });

  $(window).resize(() => {
    $table.bootstrapTable('resetView', {
      height: getHeight()
    });
  });

}


function getIdSelections() {
$res_array = [];
for (var val in $table.bootstrapTable('getSelections')) {
    $result = $table.bootstrapTable('getSelections')[val]['id'];
    $res_array.push($result);
}
    return $res_array;
}


function operateFormatter(value, row, index) {
  return [
    '<a class="modify" href="javascript:void(0)" title="Modify">',
    '<i class="glyphicon glyphicon-pencil"></i>',
    '</a>  &nbsp;&nbsp;&nbsp;&nbsp;',
    '<a class="view-one-question" href="javascript:void(0)" title="View">',
    '<i class="glyphicon glyphicon-eye-open"></i>',
    '</a>'
    // '<a class="remove" href="javascript:void(0)" title="Remove">',
    // '<i class="glyphicon glyphicon-remove"></i>',
    // '</a>'
  ].join('');
}


function getHeight() {
  return $(window).height() - $('h1').outerHeight(true);
}

function getMainTableInfo(questionName) {
  var mainTableName;
  var newButtonURL;
  var questionType;
  var updateURL;
  switch(questionName) {
    case 'Read Aloud':
      mainTableName = 'rainfo';
      newButtonURL = 'questionmgt/ra';
      questionType = 'ra';
      updateURL = 'questionmgt/ra_update';
      break;
    case 'Repeat Sentence':
      mainTableName = 'rsinfo';
      newButtonURL = 'questionmgt/rs';
      questionType = 'rs';
      updateURL = 'questionmgt/rs_update';
      break;

  }

  return {'mainTableName' : mainTableName, 'newButtonURL' : newButtonURL, 'questionType': questionType, 'updateURL': updateURL};
}

function ridToQuestionName(rid) {
  var QuestionName;
  switch(rid) {
    case '1':
      QuestionName = 'Read Aloud';
      break;
    case '2':
      QuestionName = 'Repeat Sentence';
      break;

    default:
      QuestionName = 'Read Aloud';
  }

  return QuestionName;
}

function newButton() {
  var questionName = $('#dropdown-selected').text();
  // alert(questionName);
  var newButtonURL = getMainTableInfo(questionName)['newButtonURL'];
  // alert(newButtonURL);
  location.href = newButtonURL;
}

function fetchDataTable(this_text) {
  $('#dropdown-selected').text(this_text);
  var questionName = $('#dropdown-selected').text();
  var mainTableName = getMainTableInfo(questionName)['mainTableName'];
  // alert(mainTableName);

  $.ajax({
    method: "GET",
    url: "questionmgt/questiondata",
    data: { mainTableName: mainTableName,
    '_token': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    success: function (result) {
      $('#table').bootstrapTable("load", result);
      // console.log(typeof(result));
      // alert('success');
    },
    error: function(msg, result) {
      console.log('ajax.error',msg);
      alert('msg');
      // alert(result);
      }
  });
}


$(document).ready(function() {

  window.operateEvents = {
    'click .modify': function (e, value, row, index) {
      // alert(`You click like action, row: ${JSON.stringify(row)}`);
      let $id = row['id'];
      // alert($id);
      let questionName = $('#dropdown-selected').text();
      // alert(questionName);
      let updateURL = getMainTableInfo(questionName)['updateURL'];
      // alert(updateURL);

      window.location.href = updateURL+"?qid="+$id;
    },

    'click .view-one-question': function (e, value, row, index) {
      // alert(`You click like action, row: ${JSON.stringify(row)}`);
      let $id = row['id'];
      // alert($id);
      let questionName = $('#dropdown-selected').text();
      // alert(questionName);
      let updateURL = getMainTableInfo(questionName)['updateURL'];
      // alert(updateURL);

      window.location.href = updateURL+"?qid="+$id;
    }  

    };

  initTable();


  $('#table').on('load-success.bs.table', function (e, arg1, arg2) {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var rid;
    if (url.searchParams.get("rid")) {  rid = url.searchParams.get("rid"); } else { rid = '' };
    // alert(rid);
    var questionName = ridToQuestionName(rid);
    fetchDataTable(questionName);
    // console.log('good' );
  });



  $(document).on('click', '.remove', function() {
    toastr.success('The selected record has been deleted, cheers!');
  });

  $('#remove').on('click', function () {
    $('#deleteWarning').modal();
  });

  $('#confirm_deletion').on('click', function() {
    const colValue = ids = getIdSelections();
    const actionName = 'delete';
    var questionName = $('#dropdown-selected').text();
    var questionType = getMainTableInfo(questionName)['questionType'];
    // alert(questionType);

    $.ajax({
      method: "POST",
      url: "questionmgt/question_deletion",
      data: { actionName: actionName, questionType: questionType, colValue: colValue,
              '_token': $('meta[name="csrf-token"]').attr('content')
            },

      success: function(data) {
        // alert(data);
        // return data; 
     },
      error: function(jqxhr, status, exception) {
        alert('Exception:', exception);
      }
    }).done(function( msg ) {
      $('#test').html(msg);
      // alert(msg);
    });

    $table.bootstrapTable('remove', {
      field: 'id',
      values: ids
    });
    
    $remove.prop('disabled', true);
    $('#deleteWarning').modal('hide');
    toastr.success('Records are deleted, cheers!');
  });

  // ajax information from diff tables
  $(".dropdown-menu li a").click(function () {
    var selText = $(this).text();
    $("#dropdown-selected").html(selText);

    fetchDataTable(selText);
  })

  $('#addnew').on('click', function() {
    newButton();
  });

});

