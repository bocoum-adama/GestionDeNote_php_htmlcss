<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *, ::before, ::after {
    box-sizing: border-box;
    margin: 0; 
    padding: 0;
}

body {
    height: 100vh;
 padding: 20px;
    font-family: Arial, Helvetica, sans-serif;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}

.table-style  {
    border-collapse: collapse;
    box-shadow: 0 5px 50px rgba(0,0,0,0.15);
    cursor: pointer;
    margin: 0px auto;
    border: 2px solid midnightblue;
}

thead tr {
    background-color: midnightblue;
    color: #fff;
    text-align: left;
}

th, td {
    padding: 15px 20px;
    text-align: center;
}

tbody tr, td, th {
    border: 1px solid #ddd;
}

tbody tr:nth-child(even){
    background-color: #f3f3f3;
}

@media screen and (max-width: 550px) {
  body {
    align-items: flex-start;
  }
  .table-style  {
    width: 100%;
    margin: 0px;
    font-size: 10px;
  }
  th, td {
    padding: 10px 7px;
}

}
    </style>
</head>
<body>
<table class="table-style">

<thead>
    <tr>
        <th>Title 1</th>
        <th>Title 2</th>
        <th>Title 3</th>
        <th>Title 4</th>
        <th>Title 5</th>
    </tr>
</thead>


<tbody>
    <tr>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
    </tr>
    <tr>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
    </tr>
    <tr>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
    </tr>
    <tr>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
    </tr>
    <tr>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
        <td>Content</td>
    </tr>
</tbody>

</table>


</body>
</html>