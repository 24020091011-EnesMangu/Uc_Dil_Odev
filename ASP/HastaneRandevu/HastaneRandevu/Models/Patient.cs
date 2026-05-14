namespace HastaneRandevu.Models
{
    public class Patient
    {
        public int ID { get; set; }
        public string TCNo { get; set; }
        public string FullName { get; set; }
        public string Phone { get; set; }
        public string BloodType { get; set; }

        public ICollection<Appointment> Appointments { get; set; }
    }
}