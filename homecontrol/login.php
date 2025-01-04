<div class="centerContainerSmall">
	<div class="zoneCont" id="zoneCont_login">
    	<div class="zoneTitel">Login</div>
        <div class="zoneIcoon"></div>
        <div class="zoneContMid">
        	<form method="post" name="form1" id="form1" />
                <div class="kringCont">
                    <div class="kringUser">User</div>
                    <div class="kringInput"><input type="text" class="inputbox" name="user" id="user" /></div>
                </div>
                <div class="kringCont">
                    <div class="kringUser">Pass</div>
                    <div class="kringInput"><input type="password" class="inputbox" name="pw" id="pw" /></div>
                </div>
                <div class="tussenLijn"></div>
                <div class="loginBTNCont">
                	<input type="submit" class="submitBTN" name="sub" id="sub">
                    <div class="loginBTN" onclick="form1.submit()">login</div>
                </div>
            </form>
        </div>   
    </div>
    <div class="loginError"><?=$error;?></div>
</div>