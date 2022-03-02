<html>
  <head>
    <title>PHP Test</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body dir="rtl">
    <?php 
    # functions:
    # 1- a function to determaine citizen's group accourding to electricity consumption per hour
    function findCitizenGroup($consumptionPerHour){
      if($consumptionPerHour < THRESHOLDS[0])
        return 0;
      elseif ($consumptionPerHour < THRESHOLDS[1])
        return 1;
      elseif ($consumptionPerHour < THRESHOLDS[2])
        return 2;
      else
        return 3;
      }
    # 2- a function to calculate the total cost of monthly electricity consumption accourding to the cost of one kilowatt
    function calcTotalCost($electricityConsumption, $kilowattCost){
      return $electricityConsumption * $kilowattCost;
    }

    # Constants:
    define('UNIT','كيلو وات');
    define('CURRENCY','دولار أمريكي');
    const MONTHNAMES = array('يناير','فبراير','مارس','إبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر');
    const MONTHDAYS = array(31,28,31,30,31,30,31,31,30,31,30,31);
    const GROUPS = array('لا يوجد','الأولي','الثانية','الثالثة');
    const THRESHOLDS = array(1,300,600);
    const PRICES = array(0,0.5,1,2);
    define('DAYHOURS','24');
    define('BILLTITLE','فاتورة استهلاك الكهرباء لشهر');
    define('COMPANYNAME','شركة الكهرباء');
    
    # Variables:
    $citizenName = 'عبد الله محمد السيد';
    $electricityConsumption = 700;
    $month = 2;
    $consumptionPerHour = $electricityConsumption / (MONTHDAYS[$month-1] * DAYHOURS);
    $citizenGroup = findCitizenGroup($consumptionPerHour);
    $kilowattCost = PRICES[$citizenGroup];
    $totalConsumptionCost = calcTotalCost($electricityConsumption, $kilowattCost);
    
    # Output bill
      echo 
      "
      <article>
      <section>
      <table>
      <div class='container'>
      <label class='company'>".COMPANYNAME."</label>
      <label class='title'>".BILLTITLE." <span>".MONTHNAMES[$month-1]."</span></label>
      </div>
      <thead>
        <tr><th>اسم المواطن</th></tr>
        <tr><th>إجمالي الاستهلاك الشهري</th></tr>
        <tr><th>معدل الاستهلاك لكل ساعة</th></tr>
        <tr><th>شريحة الاستهلاك</th></tr>
        <tr><th>سعر الكيلو وات</th></tr>
        <tr><th>إجمالي مبلغ الاستهلاك</th></tr>
      </thead>
      <tbody>
        <tr><td>$citizenName</td><tr>
        <tr><td>$electricityConsumption <small>".UNIT."</small></td><tr>
        <tr><td>$consumptionPerHour <small>".UNIT."</small></td><tr>
        <tr><td>".GROUPS[$citizenGroup]."</td><tr>
        <tr><td>$kilowattCost <small>".CURRENCY."</small></td><tr>
        <tr><td>$totalConsumptionCost <small>".CURRENCY."</small></td><tr>
      </tbody>
      </table>
      <label class='group'>بيان شرائح الإستهلاك:</label>
      <ul>
      	<li>الشريحة ".GROUPS[1]." من ".THRESHOLDS[0]." إلي ".THRESHOLDS[1]." ".UNIT." / ساعة وتكلفتها ".PRICES[1]." ".CURRENCY." لكل ".UNIT."</li>
        <li>الشريحة ".GROUPS[2]." من ".THRESHOLDS[1]." إلي ".THRESHOLDS[2]." ".UNIT." / ساعة وتكلفتها ".PRICES[2]." ".CURRENCY." لكل ".UNIT."</li>
        <li>الشريحة ".GROUPS[3]." أكثر من ".THRESHOLDS[2]." ".UNIT." / ساعة وتكلفتها ".PRICES[3]." ".CURRENCY." لكل ".UNIT."</li>
      </ul>
      <input type='button' name='print' value='طباعة الفاتورة' onclick='window.print();' />
      </section>
      </article>
      ";
     ?> 
  </body>
</html>