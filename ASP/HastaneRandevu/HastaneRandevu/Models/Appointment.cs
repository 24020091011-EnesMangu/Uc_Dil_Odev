namespace HastaneRandevu.Models
{
    public class Appointment
    {
        public int ID { get; set; }
        public int PatientID { get; set; }
        public int DoctorID { get; set; }
        public DateTime Date { get; set; }
        public string Complaint { get; set; }

        public Patient Patient { get; set; }
        public Doctor Doctor { get; set; }
        public Prescription Prescription { get; set; } // Birebir ilişki
    }
}