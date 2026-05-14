<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*, db.DBConnection" %>
<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="style.css"></link>
    <meta charset="UTF-8">
    <title>Mekan Detayı</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f9; padding: 40px; }
        .card { background: white; max-width: 600px; margin: auto; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .event-box { background: #fff9eb; padding: 15px; border-left: 5px solid #f1c40f; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <%
            String placeId = request.getParameter("placeId");
            try (Connection conn = DBConnection.getConnection()) {
                PreparedStatement ps = conn.prepareStatement("SELECT * FROM places WHERE id = ?");
                ps.setInt(1, Integer.parseInt(placeId));
                ResultSet rs = ps.executeQuery();
                if(rs.next()) {
        %>
                <h2><%= rs.getString("place_name") %></h2>
                <p style="color: #666;"><%= rs.getString("description") %></p>
                <hr>
                <h3>📅 Yaklaşan Etkinlikler</h3>
                <%
                    PreparedStatement psE = conn.prepareStatement("SELECT * FROM events WHERE place_id = ?");
                    psE.setInt(1, Integer.parseInt(placeId));
                    ResultSet rsE = psE.executeQuery();
                    boolean hasEvent = false;
                    while(rsE.next()) {
                        hasEvent = true;
                %>
                    <div class="event-box">
                        <strong><%= rsE.getString("event_name") %></strong><br>
                        Tarih: <%= rsE.getDate("event_date") %> | Ücret: <%= rsE.getDouble("price") %> TL
                    </div>
                <% } if(!hasEvent) { out.print("<p>Bu mekan için planlanmış etkinlik bulunmuyor.</p>"); } %>
        <%
                }
            } catch(Exception e) { out.print("Hata: " + e.getMessage()); }
        %>
        <br>
        <a href="javascript:history.back()">← Geri Dön</a>
    </div>
</body>
</html>