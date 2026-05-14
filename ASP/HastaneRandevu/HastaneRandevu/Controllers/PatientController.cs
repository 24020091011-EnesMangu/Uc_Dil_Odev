using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using HastaneRandevu.Models;

namespace HastaneRandevu.Controllers
{
	public class PatientController : Controller
	{
		private readonly HospitalContext _context;
		public PatientController(HospitalContext context) { _context = context; }

		// Hastanın geçmiş randevularını ve detaylarını getiren metot
		public IActionResult History(int patientId)
		{
			// Entity Framework ile ilişkili tüm tabloları birbirine bağlıyoruz
			var patient = _context.Patients
				.Include(p => p.Appointments)
					.ThenInclude(a => a.Doctor)
						.ThenInclude(d => d.Clinic) // Doktorun kliniğini de al
				.Include(p => p.Appointments)
					.ThenInclude(a => a.Prescription) // Varsa reçeteyi al
				.FirstOrDefault(p => p.ID == patientId);

			if (patient == null)
			{
				return NotFound("Hasta bulunamadı.");
			}

			return View(patient);
		}
	}
}