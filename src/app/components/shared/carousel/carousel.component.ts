import { Component, Input, OnInit, QueryList, ViewChildren } from '@angular/core';
import { interval } from 'rxjs/internal/observable/interval';
import { CarouselItemComponent } from '../carousel-item/carousel-item.component';
import { CarouselItem} from '../carousel-item/carousel-item.interface';

@Component({
  selector: 'adk-carousel',
  templateUrl: './carousel.component.html',
  styleUrls: ['./carousel.component.css']
})
export class CarouselComponent implements OnInit {
  @ViewChildren('carouselItem') carouselItems: QueryList<CarouselItemComponent>;
  @Input() items: Array<CarouselItem>;

  hoovered: boolean = false;

  ngOnInit() {
    //in 10 seconds do something
    interval(5000).subscribe(x => {
      let nextSlideIndex = this.selectedIndex == this.items.length - 1 ? 0 : this.selectedIndex + 1;
      if(!this.hoovered) {
        this.select(nextSlideIndex);
      }
    });
  }

  public selectedIndex: number = 0;

  public select(index: number) {
    if (this.selectedIndex !== index) {
      let previousSelectedIndex = this.selectedIndex;
      let previousItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == previousSelectedIndex)
        .elementRef.nativeElement as HTMLElement;
      previousItem.classList.add("carousel-prev-item");
      this.selectedIndex = index;
      let newItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
        .elementRef.nativeElement as HTMLElement;
      if (previousSelectedIndex < this.selectedIndex) {
        previousItem.animate([
          { left: '0' },
          { left: '-100%' }
        ], {
          duration: 500,
          fill: "forwards"
        }).onfinish = function() {
          previousItem.classList.remove("carousel-prev-item");
        };
        newItem.style.left = "100%";
        newItem.animate([
          { left: '100%' },
          { left: '0' }
        ], {
          duration: 500,
          fill: "forwards"
        });
      } else {
        previousItem.animate([
          { left: '0' },
          { left: '100%' }
        ], {
          duration: 500,
          fill: "forwards"
        }).onfinish = function() {
          previousItem.classList.remove("carousel-prev-item");
        };
        newItem.style.left = "-100%";
        newItem.animate([
          { left: '-100%' },
          { left: '0' }
        ], {
          duration: 500,
          fill: "forwards"
        });
      }
     
    }
  }

  public slideRight() {
    let previousSelectedIndex = this.selectedIndex;
    let previousItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == previousSelectedIndex)
      .elementRef.nativeElement as HTMLElement;
    previousItem.classList.add("carousel-prev-item");
    this.selectedIndex = this.selectedIndex >= this.items.length-1 ? 0 : ++this.selectedIndex;
    previousItem.animate([
      { left: '0' },
      { left: '-100%' }
    ], {
      duration: 500,
      fill: "forwards"
    }).onfinish = function() {
      previousItem.classList.remove("carousel-prev-item");
    };
    let newItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
      .elementRef.nativeElement as HTMLElement;
    newItem.style.left = "100%";
    newItem.animate([
      { left: '100%' },
      { left: '0' }
    ], {
      duration: 500,
      fill: "forwards"
    });
    this.itemDraggedToRight = false;
    this.itemDraggedToLeft = false;
    this.currentItemLeftProperty = 0;
    this.nextItemLeftProperty = 100;
    this.prevItemLeftProperty = -100;
  }

  public slideLeft() {
    let previousSelectedIndex = this.selectedIndex;
    let previousItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == previousSelectedIndex)
      .elementRef.nativeElement as HTMLElement;
    previousItem.classList.add("carousel-prev-item");
    this.selectedIndex = this.selectedIndex === 0 ? this.items.length-1 : --this.selectedIndex;
    previousItem.animate([
      { left: '0' },
      { left: '100%' }
    ], {
      duration: 500,
      fill: "forwards"
    }).onfinish = function() {
      previousItem.classList.remove("carousel-prev-item");
    };
    let newItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
      .elementRef.nativeElement as HTMLElement;
    newItem.style.left = "-100%";
    newItem.animate([
      { left: '-100%' },
      { left: '0' }
    ], {
      duration: 500,
      fill: "forwards"
    });
    this.itemDraggedToRight = false;
    this.itemDraggedToLeft = false;
    this.currentItemLeftProperty = 0;
    this.nextItemLeftProperty = 100;
    this.prevItemLeftProperty = -100;
  }

  private completeSwipeRight() {
    let previousSelectedIndex = this.selectedIndex;
    let previousItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == previousSelectedIndex)
      .elementRef.nativeElement as HTMLElement;
    previousItem.classList.add("carousel-prev-item");
    this.selectedIndex = this.selectedIndex === 0 ? this.items.length-1 : --this.selectedIndex;
    previousItem.animate([
      { left: this.currentItemLeftProperty.toString(10)+'%' },
      { left: '100%' }
    ], {
      duration: 500,
      fill: "forwards"
    }).onfinish = function() {
      previousItem.classList.remove("carousel-prev-item");
    };
    let newItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
      .elementRef.nativeElement as HTMLElement;
    newItem.animate([
      { left: this.prevItemLeftProperty.toString(10)+'%' },
      { left: '0' }
    ], {
      duration: 500,
      fill: "forwards"
    });

    this.currentItemLeftProperty = 0;
    this.prevItemLeftProperty = -100;
  }

  private completeSwipeLeft() {
    let previousSelectedIndex = this.selectedIndex;
    let previousItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == previousSelectedIndex)
      .elementRef.nativeElement as HTMLElement;
    previousItem.classList.add("carousel-prev-item");
    this.selectedIndex = this.selectedIndex >= this.items.length-1 ? 0 : ++this.selectedIndex;
    previousItem.animate([
      { left: this.currentItemLeftProperty.toString(10)+'%' },
      { left: '-100%' }
    ], {
      duration: 500,
      fill: "forwards"
    }).onfinish = function() {
      previousItem.classList.remove("carousel-prev-item");
    };
    let newItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
      .elementRef.nativeElement as HTMLElement;
    newItem.animate([
      { left: this.nextItemLeftProperty.toString(10)+'%' },
      { left: '0' }
    ], {
      duration: 500,
      fill: "forwards"
    });

    this.currentItemLeftProperty = 0;
    this.nextItemLeftProperty = 100;
  }

  private itemDraggedToRight = false;
  private itemDraggedToLeft = false;
  private currentItemLeftProperty = 0;
  private nextItemLeftProperty = 100;
  private prevItemLeftProperty = -100;

  private dragItem(direction: number): void {
    if (direction > 0) { //right, next ++
      this.itemDraggedToRight = true;
      let currentItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
        .elementRef.nativeElement as HTMLElement;

      let prevItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex ==
        (this.selectedIndex === 0 ? this.items.length-1 : this.selectedIndex - 1))
        .elementRef.nativeElement as HTMLElement;
      prevItem.classList.add("carousel-prev-item");
      prevItem.style.left = "-100%";

      let percentageToMove = direction/currentItem.offsetWidth * 100;
      if (percentageToMove <= 100) {
      this.currentItemLeftProperty = 0 + percentageToMove;
        let value = this.currentItemLeftProperty.toString(10)+'%';
        currentItem.animate([
          { left: '0' },
          { left: value }
        ], {
          duration: 0,
          fill: "forwards"
        });
        
        this.prevItemLeftProperty = -100 + percentageToMove;
        value = this.prevItemLeftProperty.toString(10)+'%';
        prevItem.animate([
          { left: '-100%' },
          { left: value }
        ], {
          duration: 0,
          fill: "forwards"
        });
      }
    } else { //left, next --
      this.itemDraggedToLeft = true;
      let currentItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
        .elementRef.nativeElement as HTMLElement;
      let nextItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex ==
        (this.selectedIndex >= this.items.length-1 ? 0 : this.selectedIndex + 1))
        .elementRef.nativeElement as HTMLElement;
      nextItem.classList.add("carousel-next-item");
      nextItem.style.left = "100%";
      
      let percentageToMove = direction/currentItem.offsetWidth * 100;
      if (percentageToMove >= -100) {
        this.currentItemLeftProperty = 0 + percentageToMove;
        let value = this.currentItemLeftProperty.toString(10)+'%';
        currentItem.animate([
          { left: '0' },
          { left: value }
        ], {
          duration: 0,
          fill: "forwards"
        });
        
        this.nextItemLeftProperty = 100 + percentageToMove;
        value = this.nextItemLeftProperty.toString(10)+'%';
        console.log(value);
        nextItem.animate([
          { left: '100%' },
          { left: value }
        ], {
          duration: 0,
          fill: "forwards"
        });
      }
    }

  }

  private swipeCoord?: [number, number];
  private swipeTime?: number;

  swipe(e: TouchEvent, when: string): void {
    const coord: [number, number] = [e.changedTouches[0].clientX, e.changedTouches[0].clientY];
    const time = new Date().getTime();

    if (when === 'start') {
      this.swipeCoord = coord;
      this.swipeTime = time;
    } else if (when === 'end') {
      const direction = [coord[0] - this.swipeCoord[0], coord[1] - this.swipeCoord[1]];
      const duration = time - this.swipeTime;

      let currentItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
        .elementRef.nativeElement as HTMLElement;
      let percentageToMove = direction[0]/currentItem.offsetWidth * 100;
      if (Math.abs(percentageToMove) > 30) { // Long enough
          const swipe = direction[0] < 0 ? 'next' : 'previous';
          // Do whatever you want with swipe
          if (swipe === "next") {
            this.completeSwipeLeft();
          } else {
            this.completeSwipeRight();
          }
      } else {
        if (this.itemDraggedToRight) {
          let currentItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
            .elementRef.nativeElement as HTMLElement;
          let prevItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex ==
            (this.selectedIndex === 0 ? this.items.length-1 : this.selectedIndex - 1))
            .elementRef.nativeElement as HTMLElement;
          currentItem.animate([
              { left: this.currentItemLeftProperty.toString(10)+'%' },
              { left: '0' }
            ], {
              duration: 300,
              fill: "forwards"
            });
          prevItem.animate([
              { left: this.prevItemLeftProperty.toString(10)+'%' },
              { left: '-100%' }
            ], {
              duration: 300,
              fill: "forwards"
            }).onfinish = function() {
              prevItem.classList.remove("carousel-prev-item");
            };
        } else if (this.itemDraggedToLeft) {
          let currentItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex == this.selectedIndex)
            .elementRef.nativeElement as HTMLElement;
          let nextItem = this.carouselItems.find(carouselItem => carouselItem.itemIndex ==
            (this.selectedIndex >= this.items.length-1 ? 0 : this.selectedIndex + 1))
            .elementRef.nativeElement as HTMLElement;
          currentItem.animate([
              { left: this.currentItemLeftProperty.toString(10)+'%' },
              { left: '0' }
            ], {
              duration: 300,
              fill: "forwards"
            });
          nextItem.animate([
              { left: this.nextItemLeftProperty.toString(10)+'%' },
              { left: '100%' }
            ], {
              duration: 300,
              fill: "forwards"
            }).onfinish = function() {
              nextItem.classList.remove("carousel-next-item");
            };
        }
        this.itemDraggedToRight = false;
        this.itemDraggedToLeft = false;
        this.currentItemLeftProperty = 0;
        this.nextItemLeftProperty = 100;
        this.prevItemLeftProperty = -100;
      }
    }
  }
  
  moveItem(e: TouchEvent): void {
    const coord: [number, number] = [e.changedTouches[0].clientX, e.changedTouches[0].clientY];
    const direction = [coord[0] - this.swipeCoord[0], coord[1] - this.swipeCoord[1]];
    this.dragItem(direction[0]);
  }
}