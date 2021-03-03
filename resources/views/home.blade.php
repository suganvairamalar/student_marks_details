<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="{{URL::asset('js/jqueryv3.min.js')}}"></script> 
<script type="text/javascript" src="{{URL::asset('js/bootstrapv3.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('css/bootstrapv3.min.css')}}" type="text/css"/>
<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: salmon;
  color: lemonchiffon;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
</head>
<body>

<div class="header">
  <a href="#default" class="logo">STUDENT MARK DETAILS</a>
  <div class="header-right">     
    <a href="{{route('student_detail.index')}}">STUDENT DETAILS</a>    
    <a href="{{route('student_mark.index')}}">STUDENT MARKS</a>    
    
  </div>
</div>

<div style="padding-left:20px">
  
</div>
<script type="text/javascript">
$('.header-right').on('click', function() {
    $(this).closest('.header-right').find('a.active').removeClass('active');
    $(this).addClass('active');
  });

</script>
</body>
</html>
