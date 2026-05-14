<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css"></link>
    <meta charset="UTF-8">
    <title>Yeni Mekan Ekle</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f9; padding: 40px; }
        form { background: white; max-width: 400px; margin: auto; padding: 25px; border-radius: 10px; }
        input, select, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { background: #27ae60; color: white; border: none; padding: 12px; width: 100%; border-radius: 5px; cursor: pointer; }
    </style>
    
</head>
<body>
    <form action="save_place.jsp" method="POST">
        <h3>Yeni Mekan Kaydı</h3>
        <input type="hidden" name="cityId" value="<%= request.getParameter("cityId") %>">
        
        <label>Mekan Adı:</label>
        <input type="text" name="placeName" required>
        
        <label>Tür:</label>
        <select name="placeType">
            <option>Müze</option>
            <option>Park</option>
            <option>Restoran</option>
            <option>Tarihi Yer</option>
        </select>
        
        <label>Açıklama:</label>
        <textarea name="description" rows="4"></textarea>
        
        <button type="submit">Sisteme Kaydet</button>
        <a href="javascript:history.back()" style="display:block; text-align:center; margin-top:15px; color:#999; text-decoration:none;">İptal Et</a>
    </form>
</body>
</html>