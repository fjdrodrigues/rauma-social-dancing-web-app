import { Component } from '@angular/core';
import { environment } from 'src/environments/environment';
import { CarouselItem } from '../components/shared/carousel-item/carousel-item.interface';

@Component({
  selector: 'home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent {
  public verticalCarouselItems: Array<CarouselItem> = [
		{
			url: "https://i.ibb.co/tBvbpcV/collage-1-800x1000.png",
			title: "New Season",
			description: "Salsa, Bachata and Kizomba classes start in September",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			url: "https://i.ibb.co/Dtg04P7/collage-2-800x1000.png",
			title: "Beginner Classes",
			description: "Salsa, Bachata and Kizomba classes on Tuesdays",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			url: "https://i.ibb.co/mbKcM8G/collage-3-800x1000.png",
			title: "Intermediate Classes",
			description: "Salsa and Bachata classes on Wednesdays",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			url: "https://i.ibb.co/sm6jqht/social-2021-06-17-960x1200.png",
			title: "Socials",
			description: "Every Friday and Sunday",
      hyperlink: environment.baseUrl+"/classes"
		}
	];

	public horizontalCarouselItems: Array<CarouselItem> = [
		{
			url: "https://i.ibb.co/Rp1YXn8/collage-1-900x425.png",
			title: "New Season",
			description: "Salsa, Bachata and Kizomba classes start in September",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			url: "https://i.ibb.co/fDxJNhC/collage-2-900x425.png",
			title: "Beginner Classes",
			description: "Salsa, Bachata and Kizomba classes on Tuesdays",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			url: "https://i.ibb.co/F6D1Vs4/collage-3-900x425.png",
			title: "Intermediate Classes",
			description: "Salsa and Bachata classes on Wednesdays",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			url: "https://i.ibb.co/R2CpHW2/social-2021-06-17-900x425.png",
			title: "Socials",
			description: "Every Friday and Sunday",
      hyperlink: environment.baseUrl+"/classes"
		}
	];
}
