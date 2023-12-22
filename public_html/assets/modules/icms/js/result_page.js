$(document).ready(function () {
  $("#btn-view_notes").click(function () {
    alert("test");
    // $('#mdl-view_notes').modal('show');
  });

  $(".btn-select-notif_method").click(function () {
    alert("test");
    // const { value: fruit } = await Swal.fire({
    //   title: 'Select field validation',
    //   input: 'select',
    //   inputOptions: {
    //     'Fruits': {
    //       apples: 'Apples',
    //       bananas: 'Bananas',
    //       grapes: 'Grapes',
    //       oranges: 'Oranges'
    //     },
    //     'Vegetables': {
    //       potato: 'Potato',
    //       broccoli: 'Broccoli',
    //       carrot: 'Carrot'
    //     },
    //     'icecream': 'Ice cream'
    //   },
    //   inputPlaceholder: 'Select a fruit',
    //   showCancelButton: true,
    //   inputValidator: (value) => {
    //     return new Promise((resolve) => {
    //       if (value === 'oranges') {
    //         resolve()
    //       } else {
    //         resolve('You need to select oranges :)')
    //       }
    //     })
    //   }
    // })
    
    // if (fruit) {
    //   Swal.fire(`You selected: ${fruit}`)
    // }
  });


  $(".btn-set_notif").click(function(){
    icmsMessage({
        type: "msgConfirmation",
        title: "You are about to add new agency.<br>Click save button if you wish to continue.",
        onConfirm: function () {
            icmsMessage({
                type: "msgPreloader",
                visible: true
            });
        }
    });
  });
});


$('.btn-end-session').click(function () {

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);

  var tcid = urlParams.get('tcid');
  var ovc = urlParams.get('ovc')

  let data =  dg__objectAssign({
    type: 'sessionToInactive',
    tcid: tcid,
    ovc: ovc
  });

  $.post(sAjaxWebPublic,data, function (rs) {
      console.log(rs);
      icmsMessage({
          type: 'msgPreloader',
          visible: true
      });

      if (parseInt(rs.data.flag) == 1) {
        window.location.assign(window.location.protocol + '/tracking');
      } 

  }, 'json');
});
