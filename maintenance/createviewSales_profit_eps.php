<?php
include("config.inc.php");


set_time_limit(20000);
//-------------------------------------------------------------------------------------------
//need to uncomment when you want to create view 
/*$result=mysqli_query($link,"create or replace View view_SortCompanyBySalesGrowth  AS SELECT * 
FROM  sales WHERE GrowthAlwaysPositive = '1'
ORDER BY CAST(  GrowthPer AS DECIMAL( 10, 2 ) ) DESC ");*/
//----------------------------------------------------------------------------------------


//-------------------------------------------------------------------------------------------
//need to uncomment when you want to create view 
/*$result1=mysqli_query($link,"create or replace View view_SortCompanyByProfitGrowth  AS SELECT * 
FROM  operating_profit WHERE GrowthAlwaysPositive = '1'
ORDER BY CAST(  GrowthPer AS DECIMAL( 10, 2 ) ) DESC ");*/
//-------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------
//need to uncomment when you want to create view 
/*$result2=mysqli_query($link,"create or replace View view_SortCompanyByEpsGrowth  AS SELECT * 
FROM  eps WHERE GrowthAlwaysPositive = '1'
ORDER BY CAST(  GrowthPer AS DECIMAL( 10, 2 ) ) DESC ");*/
//-------------------------------------------------------------------------------------------


//-------------------------------------------------------------------------------------------

//need to uncomment when you want to create view 
//by profit , sales , earnings
/*$result3=mysqli_query($link,"create or replace View view_SortCompanyByProfitSalesEpsGrowth 
(vcompanynumber , vProfitGrowthPer,vSalesGrowthPer,vEpsGrowthPer) 
 AS select view_sortcompanybyprofitgrowth.companynumber , view_sortcompanybyprofitgrowth.GrowthPer ,view_sortcompanybysalesgrowth.GrowthPer, view_sortcompanybyepsgrowth.GrowthPer from view_sortcompanybyprofitgrowth, view_sortcompanybysalesgrowth,view_sortcompanybyepsgrowth where (view_sortcompanybyprofitgrowth.companynumber = view_sortcompanybysalesgrowth.companynumber ) and  (view_sortcompanybysalesgrowth.companynumber = view_sortcompanybyepsgrowth.companynumber ) limit 400");*/
 //-------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------
// by sales , profit , eps
/*$result4=mysqli_query($link,"create or replace View view_SortCompanyBySalesProfitEpsGrowth 
(vcompanynumber , vSalesGrowthPer,vProfitGrowthPer,vEpsGrowthPer)
 AS select view_sortcompanybysalesgrowth.companynumber , view_sortcompanybysalesgrowth.GrowthPer ,view_sortcompanybyprofitgrowth.GrowthPer, view_sortcompanybyepsgrowth.GrowthPer from view_sortcompanybysalesgrowth, view_sortcompanybyprofitgrowth,view_sortcompanybyepsgrowth where (view_sortcompanybysalesgrowth.companynumber = view_sortcompanybyprofitgrowth.companynumber ) and  (view_sortcompanybyprofitgrowth.companynumber = view_sortcompanybyepsgrowth.companynumber ) limit 400");*/
 //-------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------

// by earning , profit , sales
/*$result5=mysqli_query($link,"create or replace View view_SortCompanyByEpsProfitSalesGrowth  
(vcompanynumber , vEpsGrowthPer,vProfitGrowthPer,vSalesGrowthPer)
AS select view_sortcompanybyepsgrowth.companynumber , view_sortcompanybyepsgrowth.GrowthPer ,view_sortcompanybyprofitgrowth.GrowthPer, view_sortcompanybysalesgrowth.GrowthPer from view_sortcompanybyepsgrowth, view_sortcompanybyprofitgrowth,view_sortcompanybysalesgrowth where (view_sortcompanybyepsgrowth.companynumber = view_sortcompanybyprofitgrowth.companynumber ) and  (view_sortcompanybyprofitgrowth.companynumber = view_sortcompanybysalesgrowth.companynumber ) limit 400");*/
//-------------------------------------------------------------------------------------------

//need to uncomment when you want to create view 
//quarter 2 and 3 Op growth
$result=mysqli_query($link,"create or replace View view_sortcompanybyQuarter1OPGrowth  AS SELECT * 
FROM  data_companies_curr ORDER BY CAST(  growthOP_qtr2 AS DECIMAL( 10, 2 ) ) DESC ");

//quarter 2 and 3 sales growth
//need to uncomment when you want to create view 
$result=mysqli_query($link,"create or replace View view_sortcompanybyQuarter1SalesGrowth  AS SELECT * 
FROM  data_companies_curr ORDER BY CAST(  growthSales_qtr2 AS DECIMAL( 10, 2 ) ) DESC ");

		
		echo "PROCESSING COMPLETED!!!!!!!";
		
?>	