using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using HastaneRandevu.Models;

namespace HastaneRandevu.Controllers
{
	public class AppointmentController : Controller
	{
		private readonly HospitalContext _context;
		public AppointmentController(HospitalContext context) { _context = context; }

		// 1. Randevu Alma Formunu Gösteren Metot (GET)
		[HttpGet]
		public IActionResult Create(int doctorId)
		{
			var doctor = _context.Doctors.Find(doctorId);

			// Formda göstermek için doktor bilgilerini sayfaya paketliyoruz
			ViewBag.DoctorName = doctor.FullName;
			ViewBag.DoctorId = doctor.ID;

			// Demo olduğu için ID'si 1 olan hastayı varsayılan kabul ediyoruz
			ViewBag.PatientId = 1;

			return View();
		}

		// 2. Formdan Gelen Veriyi Veritabanına Kaydeden Metot (POST)
		[HttpPost]
		public IActionResult Create(Appointment app)
		{
			app.Date = DateTime.Now.AddDays(1); // Randevuyu yarına veriyoruz

			_context.Appointments.Add(app);
			_context.SaveChanges(); // SQL'e yaz

			// Kayıt bitince doktorun günlük plan sayfasına yönlendir
			return RedirectToAction("DailyPlan", new { docId = app.DoctorID });
		}

		// 3. Doktorun Günlük Randevularını Listeleyen Metot
		public IActionResult DailyPlan(int docId)
		{
			// O doktora ait randevuları, hasta bilgileriyle birlikte çekiyoruz
			var appointments = _context.Appointments
				.Include(a => a.Patient)
				.Where(a => a.DoctorID == docId)
				.ToList();

			ViewBag.DoctorId = docId;
			return View(appointments);
		}
	}
}