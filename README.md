<h1> Tasks </h1>
>Status: Finished ✔️

### It'is web application, where you will create an account and then create your pending tasks

## technologies that i used
<table>
  <tr>
    <td> PHP </td>
    <td> Mysql </td>
    <td> HTML </td>
    <td> CSS </td>
  </tr>
  <tr>
      <td> 8 </td>
      <td> 10.4.17-MariaDB </td>
      <td> 5 </td>
      <td> 3 </td>
  </tr>
</table>

## How to run the the application:
1) You will need the XAMPP or another code serve, but it must support Apache and Mysql.

2) In the application's root there will be a txt file named by "query.txt", 
it will the mysql commands for the database, you need to run all this script so the application can work.

3) If your root user has a password you will need to put it with the database's connections, 
in: Class/Data_Base.php, in the constructor at line 7 will have this command " $this->connection = mysqli_connect("localhost", "root", "here you set your root's password", "php_tasks"); ", 
you can pass the root's password right inside at the third quotation marks. And do the exactly same thing for Class/Data_Base_tasks.php, at line 7 too.
