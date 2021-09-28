import { Component } from '@angular/core';
import { environment } from 'src/environments/environment';
import { CarouselItem } from '../components/shared/carousel-item/carousel-item.interface';

@Component({
  selector: 'home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent {

	private itemsContent = [
		{
			verticalURL: "https://i.ibb.co/tBvbpcV/collage-1-800x1000.png",
			horizontalURL: "https://i.ibb.co/Rp1YXn8/collage-1-900x425.png",
			title: "Update for October",
			description: "Kizomba classes on Mondays",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			verticalURL: "https://i.ibb.co/Dtg04P7/collage-2-800x1000.png",
			horizontalURL: "https://i.ibb.co/fDxJNhC/collage-2-900x425.png",
			title: "Beginner Classes",
			description: "Solo Salsa, Couple Salsa and Couple Bachata classes on Tuesdays",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			verticalURL: "https://i.ibb.co/mbKcM8G/collage-3-800x1000.png",
			horizontalURL: "https://i.ibb.co/F6D1Vs4/collage-3-900x425.png",
			title: "Intermediate Classes",
			description: "Salsa and Bachata classes on Wednesdays",
      hyperlink: environment.baseUrl+"/classes"
		},
		{
			verticalURL: "https://i.ibb.co/sm6jqht/social-2021-06-17-960x1200.png",
			horizontalURL: "https://i.ibb.co/R2CpHW2/social-2021-06-17-900x425.png",
			title: "Socials",
			description: "Every Friday and Sunday",
      hyperlink: environment.baseUrl+"/classes"
		}
	];

  public verticalCarouselItems: Array<CarouselItem> = [
		{
			url: this.itemsContent[0].verticalURL,
			title: this.itemsContent[0].title,
			description: this.itemsContent[0].description,
      hyperlink: this.itemsContent[0].hyperlink
		},
		{url: this.itemsContent[1].verticalURL,
			title: this.itemsContent[1].title,
			description: this.itemsContent[1].description,
      hyperlink: this.itemsContent[1].hyperlink
		},
		{
			url: this.itemsContent[2].verticalURL,
			title: this.itemsContent[2].title,
			description: this.itemsContent[2].description,
      hyperlink: this.itemsContent[2].hyperlink
		},
		{
			url: this.itemsContent[3].verticalURL,
			title: this.itemsContent[3].title,
			description: this.itemsContent[3].description,
      hyperlink: this.itemsContent[3].hyperlink
		}
	];

	public horizontalCarouselItems: Array<CarouselItem> = [
		{
			url: this.itemsContent[0].horizontalURL,
			title: this.itemsContent[0].title,
			description: this.itemsContent[0].description,
      hyperlink: this.itemsContent[0].hyperlink
		},
		{
			url: this.itemsContent[1].horizontalURL,
			title: this.itemsContent[1].title,
			description: this.itemsContent[1].description,
      hyperlink: this.itemsContent[1].hyperlink
		},
		{
			url: this.itemsContent[2].horizontalURL,
			title: this.itemsContent[2].title,
			description: this.itemsContent[2].description,
      hyperlink: this.itemsContent[2].hyperlink
		},
		{
			url: this.itemsContent[3].horizontalURL,
			title: this.itemsContent[3].title,
			description: this.itemsContent[3].description,
      hyperlink: this.itemsContent[3].hyperlink
		}
	];
}
