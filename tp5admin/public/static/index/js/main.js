//更新會員餘額
function updatequta() {
	var iData = new Object;
	iData['noCache'] = 1; //設定是否重設市場項目Cache(剛交易後，取得新的資料)
	Actions = jQuery.ajax({
		type: 'POST',
		url: 'ac_memberInfo.php',
		data: iData,
		error: function (xhr) {},
		beforeSend: function (result) {},
		success: function (response) {
			var reArr = JSON.parse(response);
			if (reArr.username != '') {
				$('#quotaView').html(reArr.quotaView);
				$('#pQuotaView').html(reArr.quotaView);
				$('#quota').val(reArr.quota);
			}
           location.reload();
		}
	});
}

//更新會員餘額 不reload版
function updatequta_noreload() {
    var iData = new Object;
    iData['noCache'] = 1; //設定是否重設市場項目Cache(剛交易後，取得新的資料)
    Actions = jQuery.ajax({
        type: 'POST',
        url: 'ac_memberInfo.php',
        data: iData,
        error: function (xhr) {},
        beforeSend: function (result) {},
        success: function (response) {
            var reArr = JSON.parse(response);
            if (reArr.username != '') {
                $('#quotaView').html(reArr.quotaView);
                $('#pQuotaView').html(reArr.quotaView);
                $('#quota').val(reArr.quota);
            }

        }
    });
}
//更新會員餘額
function updatequta_page(page) {
    var iData = new Object;
    iData['noCache'] = 1; //設定是否重設市場項目Cache(剛交易後，取得新的資料)
    Actions = jQuery.ajax({
        type: 'POST',
        url: 'ac_memberInfo.php',
        data: iData,
        error: function (xhr) {},
        beforeSend: function (result) {},
        success: function (response) {
            var reArr = JSON.parse(response);
            if (reArr.username != '') {
                $('#quotaView').html(reArr.quotaView);
                $('#pQuotaView').html(reArr.quotaView);
                $('#quota').val(reArr.quota);
            }
            window.location.href=page;
        }
    });
}
function cancel_withdraw(widthdraw_id)
{
	//alert(widthdraw_id);
	var change=new Object;
	change['widthdraw_id']=widthdraw_id;
	Actions = jQuery.ajax({
            type: 'POST',
            url:  'ac_monrecord.php',
            data: change,
            error: function(xhr)
            {
                //alert('ERROR');
            },
            beforeSend:function(result)
            {

            },
            success: function(answer)
            {

               // alert(answer);

                if(answer==0)
                {
                	alert('取消提领申请成功');
                    document.location.href='monrecord.php';
                }
                else
                {

                   alert('取消提领申请失败,301-'+answer+'请重新尝试或洽询客服');
                   document.location.href='monrecord.php';
                }
               updatequta();
            }
        });
}
//這裡是會員資料修改的功能 userCenter
function alter(value)
{
    chgmun=value;
    if( chgmun=='passwd' ||  chgmun=='pickup')
    {
        if( chgmun=='passwd') $('#tag').html('登入密码更新');
        if( chgmun=='pickup') $('#tag').html('提领密码更新');
        $('#tag1').html('原始密码');
        $('#tag2').html('更新密码');
        $('#tag3').html('确认密码');
    }
    // if($('#chgmun').val()=='pickup')
    // {
    //  $('#tag').html('提领');
    //  $('#tag2').html('提领');
    //  $('#tag3').html('提领');
    // }
    if(chgmun=='email')
    {
        $('#tag').html('电邮帐号修改');
        $('#tag1').html('原始电邮');
        $('#tag2').html('更新电邮');
        $('#tag3').html('确认电邮');
        $('#old').attr('type','text');
        $('#new').attr('type','text');
        $('#new2').attr('type','text');
    }

    //alert($('#chgmun').val());
    //pass(change);
    return;
}

function isEmail(strEmail)
{
    if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
    {
        return true;
    }
    else
    {
        return false;
    }

}
function modify()
    {
        //alert($('#chgmun').val());
        if(chgmun=='email' && isEmail($('#new').val())==false)
        {
            alert('电邮帐号格式错误,请重新输入');

        }
        else if($('#old').val()!=$('#new').val() && $('#new').val()==$('#new2').val())
        {
            var change= new Object;
            change['chgmun'] = chgmun;
            change['old']=$('#old').val();
            change['new']=$('#new').val();
            change['new2']=$('#new2').val();
            pass(change);
            return;
        }
        else
        {
            alert('请检查修改资料是否输入错误');
            $('#old').val('');
            $('#new').val('');
            $('#new2').val('');
        }
    }
    function pass( change )
    {
        //alert('aaaaa');
        Actions = jQuery.ajax({
            type: 'POST',
            url:  'ac_personal.php',
            data: change,
            error: function(xhr) {

            },
            beforeSend:function(result)
            {

            },
            success: function(answer) {


                if(answer=='S')
                {
                    alert('资料修改成功');

                }
                else
                {
                    alert('资料修改失败');

                }
                window.location.reload('personal.php');
                $('#old').val('');
                $('#new').val('');
                $('#new2').val('');

            }
        });
    }
//更換驗證圖片
        function repic()
        {
            var data = new Object;
            data['url'] = "{:url('Login/checkVerify')}";
            data['step'] = 'Getpic';
            data['randcode']=$('#pic_rdcode').val();
            Actions = jQuery.ajax({
                    type: 'POST',
                    data: data,
                    url: data['url'],

                    error: function(xhr)
                    {

                    },
                    beforeSend:function(result)
                    {

                    },
                    success: function(answer)
                    {
                        console.log(answer);
                        $('#ckpic').css("display","inline-block");
                        $('#ckpic').attr("src","data:image/jpeg;base64,"+answer);
                        $('#pic').css("display","none");

                    }
                });
        }


function showstaypoint(resavepoint,notaccountmoney)
{

   alert("您尚有保留余额:\n会员互转:"+resavepoint+"\n未结算赛事:"+notaccountmoney);
}
