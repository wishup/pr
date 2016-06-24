//PHONE
var zChar = new Array(' ', '(', ')', '-', '.');
var maxphonelength = 14;
var phonevalue1;
var phonevalue2;
var cursorposition;

function ParseForNumber1(object){
    phonevalue1 = ParseChar(object.value, zChar);
}

function ParseForNumber2(object){
    phonevalue2 = ParseChar(object.value, zChar);
}

function backspacerUP(object,e) {
    if(e){
        e = e
    } else {
        e = window.event
    }
    if(e.which){
        var keycode = e.which
    } else {
        var keycode = e.keyCode
    }

    ParseForNumber1(object)

    if(keycode >= 48){
        ValidatePhone(object)
    }
}

function backspacerDOWN(object,e) {
    if(e){
        e = e
    } else {
        e = window.event
    }
    if(e.which){
        var keycode = e.which
    } else {
        var keycode = e.keyCode
    }
    ParseForNumber2(object)
}

function GetCursorPosition(){

    var t1 = phonevalue1;
    var t2 = phonevalue2;
    var bool = false
    for (i=0; i<t1.length; i++)
    {
        if (t1.substring(i,1) != t2.substring(i,1)) {
            if(!bool) {
                cursorposition=i
                window.status=cursorposition
                bool=true
            }
        }
    }
}

function ValidatePhone(object){

    var p = phonevalue1

    p = p.replace(/[^\d]*/gi,"")

    if (p.length < 3) {
        object.value=p
    } else if(p.length==3){
        pp=p;
        d4=p.indexOf('(')
        d5=p.indexOf(')')
        if(d4==-1){
            pp="("+pp;
        }
        if(d5==-1){
            pp=pp+")";
        }
        object.value = pp;
    } else if(p.length>3 && p.length < 7){
        p ="(" + p;
        l30=p.length;
        p30=p.substring(0,4);
        p30=p30+") "

        p31=p.substring(4,l30);
        pp=p30+p31;

        object.value = pp;

    } else if(p.length >= 7){
        p ="(" + p;
        l30=p.length;
        p30=p.substring(0,4);
        p30=p30+") "

        p31=p.substring(4,l30);
        pp=p30+p31;

        l40 = pp.length;
        p40 = pp.substring(0,9);
        p40 = p40 + "-"

        p41 = pp.substring(9,l40);
        ppp = p40 + p41;

        object.value = ppp.substring(0, maxphonelength);
    }

    GetCursorPosition()

    if(cursorposition >= 0){
        if (cursorposition == 0) {
            cursorposition = 2
        } else if (cursorposition <= 2) {
            cursorposition = cursorposition + 1
        } else if (cursorposition <= 4) {
            cursorposition = cursorposition + 3
        } else if (cursorposition == 5) {
            cursorposition = cursorposition + 3
        } else if (cursorposition == 6) {
            cursorposition = cursorposition + 3
        } else if (cursorposition == 7) {
            cursorposition = cursorposition + 4
        } else if (cursorposition == 8) {
            cursorposition = cursorposition + 4
            e1=object.value.indexOf(')')
            e2=object.value.indexOf('-')
            if (e1>-1 && e2>-1){
                if (e2-e1 == 4) {
                    cursorposition = cursorposition - 1
                }
            }
        } else if (cursorposition == 9) {
            cursorposition = cursorposition + 4
        } else if (cursorposition < 11) {
            cursorposition = cursorposition + 3
        } else if (cursorposition == 11) {
            cursorposition = cursorposition + 1
        } else if (cursorposition == 12) {
            cursorposition = cursorposition + 1
        } else if (cursorposition >= 13) {
            cursorposition = cursorposition
        }

        var txtRange = object.createTextRange();
        txtRange.moveStart( "character", cursorposition);
        txtRange.moveEnd( "character", cursorposition - object.value.length);
        txtRange.select();
    }
}

function ParseChar(sStr, sChar)
{

    if (sChar.length == null)
    {
        zChar = new Array(sChar);
    }
    else zChar = sChar;

    for (i=0; i<zChar.length; i++)
    {
        sNewStr = "";

        var iStart = 0;
        var iEnd = sStr.indexOf(sChar[i]);

        while (iEnd != -1)
        {
            sNewStr += sStr.substring(iStart, iEnd);
            iStart = iEnd + 1;
            iEnd = sStr.indexOf(sChar[i], iStart);
        }
        sNewStr += sStr.substring(sStr.lastIndexOf(sChar[i]) + 1, sStr.length);

        sStr = sNewStr;
    }

    return sNewStr;
}

/////////////////////SSN FORMATING AND VALIDATING
function SSNFormat(obj)
{
    fldVal = obj.value;

    for(i=0; i<fldVal.length; i++)
    {
        var nom = fldVal.charAt(i);
        if(isNaN(nom) && nom != "-")
        {
            obj.value = fldVal.substring(0,fldVal.length-1);
        }
        else { chkSSNSpacing(obj) }
    }
}

function chkSSNSpacing(obj)
{
    var fldVal = obj.value;
    if((fldVal.length == 3) || (fldVal.length == 6)){
        obj.value = fldVal + "-"
    }

    if(fldVal.length >= 12) {
        obj.value = fldVal.substring(0,fldVal.length-1);
    }
}

function formatSSN(obj)
{
    var theCount = 0;
    var theString = obj.value;
    if(theString == "") return;
    var newString = "";
    var myString = theString;
    var theLen = myString.length;
    for ( var i = 0 ; i < theLen ; i++ )
    {
        // Character codes for ints 1 - 9 are 48 - 57
        if ( (myString.charCodeAt(i) >= 48 ) && (myString.charCodeAt(i) <= 57) )
            newString = newString + myString.charAt(i);
    }
    // Now the validation to determine that the remaining string is 9 characters.
    if (newString.length == 9 )
    {
        // Now the string has been stripped of other chars it can be reformatted to ###-##-####
        var newLen = newString.length;
        var newSSN = "";
        for ( var i = 0 ; i < newLen ; i++ )
        {
            if ( ( i == 2 ) || ( i == 4 ) )
            {
                newSSN = newSSN + newString.charAt(i) + "-";
            }else{
                newSSN = newSSN + newString.charAt(i);
            }
        }
        obj.value = newSSN;
        return true;
    }else{
        alert("The Social Security Number you entered "+newString+" does not contian the correct number of digits");
        obj.focus();
        return false;
    }
}

function InitCap(obj)
{
    var str = obj.value.toLowerCase();
    var Rx = /\b([a-z']+)\b/gi;
    str = str.replace(Rx, function (w)
        {
            return w.charAt(0).toUpperCase() + w.substring(1);
        }
    );

    obj.value = str;
}