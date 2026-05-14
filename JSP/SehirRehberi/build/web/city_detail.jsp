<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*, db.DBConnection" %>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css"></link>
    <meta charset="UTF-8">
    <title>Şehir Detayları</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f0f2f5; padding: 40px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        .section { margin-top: 25px; }
        .section-title { font-size: 20px; font-weight: bold; color: #34495e; margin-bottom: 15px; display: block; }
        .list-item { padding: 12px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; }
        .btn-add { background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; float: right; }
        .back-link { color: #7f8c8d; text-decoration: none; display: inline-block; margin-bottom: 20px; }
    </style>
    
</head>
<body>
    <div class="container">
        <a href="index.jsp" class="back-link">← Şehir Listesine Dön</a>
        <a href="add_place.jsp?cityId=<%= request.getParameter("cityId") %>" class="btn-add">+ Yeni Mekan Ekle</a>
        
        <%
            String cityId = request.getParameter("cityId");
            try (Connection conn = DBConnection.getConnection()) {
                // Şehir Bilgisi
                PreparedStatement ps = conn.prepareStatement("SELECT * FROM cities WHERE id = ?");
                ps.setInt(1, Integer.parseInt(cityId));
                ResultSet rs = ps.executeQuery();
                if(rs.next()) {
        %>
                <h1><%= rs.getString("city_name") %> <small style="color:#bdc3c7;">(<%= rs.getString("region") %>)</small></h1>
                
                <div class="section">
                    <span class="section-title">Gezilecek Yerler</span>
                    <%
                        PreparedStatement psP = conn.prepareStatement("SELECT * FROM places WHERE city_id = ?");
                        psP.setInt(1, Integer.parseInt(cityId));
                        ResultSet rsP = psP.executeQuery();
                        while(rsP.next()) {
                    %>
                        <div class="list-item">
                            <span><strong><%= rsP.getString("place_name") %></strong> (<%= rsP.getString("place_type") %>)</span>
                            <a href="place_detail.jsp?placeId=<%= rsP.getInt("id") %>" style="color:#3498db;">Etkinlikler →</a>
                        </div>
                    <% } %>
                </div>

                <div class="section">
                    <span class="section-title">Yetkili Rehberler</span>
                    <%
                        String sqlG = "SELECT g.* FROM guides g JOIN city_guide cg ON g.id = cg.guide_id WHERE cg.city_id = ?";
                        PreparedStatement psG = conn.prepareStatement(sqlG);
                        psG.setInt(1, Integer.parseInt(cityId));
                        ResultSet rsG = psG.executeQuery();
                        while(rsG.next()) {
                    %>
                        <div class="list-item">
                            <span><%= rsG.getString("guide_name") %> - <em><%= rsG.getString("specialty") %></em></span>
                            <span style="color:#95a5a6;"><%= rsG.getString("contact") %></span>
                        </div>
                    <% } %>
                </div>
        <%
                }
            } catch(Exception e) { out.print("Hata: " + e.getMessage()); }
        %>
    </div>
</body>
</html>